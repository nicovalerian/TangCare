<?php

namespace App\Livewire\Admin;

use App\Models\Donation;
use App\Models\Event;
use App\Models\User;
use App\Models\Yayasan;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app', ['title' => 'Admin Dashboard - TangCare'])]
class Dashboard extends Component
{
    public string $chartPeriod = 'week';

    public function mount(): void
    {
        if (!auth()->user()?->isAdmin()) {
            abort(403, 'Unauthorized: Admin access only');
        }
    }

    /**
     * Get summary statistics.
     */
    public function getStats(): array
    {
        return [
            'totalUsers' => User::count(),
            'totalYayasans' => Yayasan::count(),
            'verifiedYayasans' => Yayasan::verified()->count(),
            'pendingYayasans' => Yayasan::whereNull('verified_at')->count(),
            'totalEvents' => Event::count(),
            'activeEvents' => Event::where('is_active', true)->count(),
            'totalDonations' => Donation::count(),
            'totalKgDonated' => Donation::where('status', Donation::STATUS_RECEIVED)->sum('weight_kg'),
        ];
    }

    /**
     * Get donation status breakdown.
     */
    public function getStatusBreakdown(): array
    {
        return [
            'pending' => Donation::where('status', Donation::STATUS_PENDING)->count(),
            'accepted' => Donation::where('status', Donation::STATUS_ACCEPTED)->count(),
            'received' => Donation::where('status', Donation::STATUS_RECEIVED)->count(),
            'rejected' => Donation::where('status', Donation::STATUS_REJECTED)->count(),
        ];
    }

    /**
     * Get donations over time data for the chart.
     */
    public function getDonationsChartData(): array
    {
        $days = match($this->chartPeriod) {
            'week' => 7,
            'month' => 30,
            'year' => 365,
            default => 7
        };

        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        
        // Group donations by date
        $donations = Donation::where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(weight_kg) as total_kg')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $counts = [];
        $kgs = [];

        // Fill in missing dates
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateStr = $date->format('Y-m-d');
            $labels[] = $days <= 7 ? $date->format('D') : ($days <= 30 ? $date->format('M j') : $date->format('M'));
            $counts[] = $donations->get($dateStr)?->count ?? 0;
            $kgs[] = round($donations->get($dateStr)?->total_kg ?? 0, 1);
        }

        // For yearly data, aggregate by month
        if ($days === 365) {
            $monthlyLabels = [];
            $monthlyCounts = [];
            $monthlyKgs = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
                $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();
                
                $monthData = Donation::whereBetween('created_at', [$monthStart, $monthEnd])
                    ->selectRaw('COUNT(*) as count, SUM(weight_kg) as total_kg')
                    ->first();
                
                $monthlyLabels[] = $monthStart->format('M');
                $monthlyCounts[] = $monthData->count ?? 0;
                $monthlyKgs[] = round($monthData->total_kg ?? 0, 1);
            }
            
            return [
                'labels' => $monthlyLabels,
                'counts' => $monthlyCounts,
                'kgs' => $monthlyKgs,
            ];
        }

        return [
            'labels' => $labels,
            'counts' => $counts,
            'kgs' => $kgs,
        ];
    }

    /**
     * Get top yayasans by donations received.
     */
    public function getTopYayasans(): array
    {
        return Yayasan::withCount(['events as donations_count' => function ($query) {
                $query->withCount('donations');
            }])
            ->with(['events' => function ($query) {
                $query->withSum(['donations as total_kg' => fn($q) => $q->where('status', Donation::STATUS_RECEIVED)], 'weight_kg');
            }])
            ->verified()
            ->get()
            ->map(function ($yayasan) {
                return [
                    'name' => $yayasan->name,
                    'total_kg' => $yayasan->events->sum('total_kg') ?? 0,
                    'events_count' => $yayasan->events->count(),
                ];
            })
            ->sortByDesc('total_kg')
            ->take(5)
            ->values()
            ->toArray();
    }

    public function updatedChartPeriod()
    {
        $this->dispatch('chartDataUpdated', $this->getDonationsChartData());
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => $this->getStats(),
            'statusBreakdown' => $this->getStatusBreakdown(),
            'chartData' => $this->getDonationsChartData(),
            'topYayasans' => $this->getTopYayasans(),
        ]);
    }
}
