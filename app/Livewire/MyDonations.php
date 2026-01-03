<?php

namespace App\Livewire;

use App\Models\Donation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('My Donations - TangCare')]
class MyDonations extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';
    public string $search = '';

    protected $queryString = [
        'statusFilter' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function setFilter(string $status): void
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }

    public function render()
    {
        $query = Donation::where('user_id', auth()->id())
            ->with(['event.yayasan'])
            ->latest();

        // Apply status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Apply search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('event', function ($eventQuery) {
                      $eventQuery->where('title', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('event.yayasan', function ($yayasanQuery) {
                      $yayasanQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $donations = $query->paginate(10);

        // Get counts for filter badges
        $counts = [
            'all' => Donation::where('user_id', auth()->id())->count(),
            'pending' => Donation::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'accepted' => Donation::where('user_id', auth()->id())->where('status', 'accepted')->count(),
            'received' => Donation::where('user_id', auth()->id())->where('status', 'received')->count(),
            'rejected' => Donation::where('user_id', auth()->id())->where('status', 'rejected')->count(),
        ];

        return view('livewire.my-donations', [
            'donations' => $donations,
            'counts' => $counts,
        ]);
    }
}
