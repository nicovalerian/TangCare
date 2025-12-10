<?php

namespace App\Livewire\Admin;

use App\Models\Yayasan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Manage Yayasans - Admin')]
class YayasanList extends Component
{
    use WithPagination;
    
    public string $search = '';
    public string $status = 'all';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function verify(int $id): void
    {
        $yayasan = Yayasan::findOrFail($id);
        $yayasan->update(['verified_at' => now()]);
        
        session()->flash('success', "Yayasan '{$yayasan->name}' has been verified.");
    }

    public function unverify(int $id): void
    {
        $yayasan = Yayasan::findOrFail($id);
        $yayasan->update(['verified_at' => null]);
        
        session()->flash('success', "Yayasan '{$yayasan->name}' verification has been revoked.");
    }

    public function render()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }
        
        $yayasans = Yayasan::with('user')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('address', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status === 'pending', fn($q) => $q->whereNull('verified_at'))
            ->when($this->status === 'verified', fn($q) => $q->whereNotNull('verified_at'))
            ->withCount('events')
            ->latest()
            ->paginate(15);
        
        $pendingCount = Yayasan::whereNull('verified_at')->count();
        
        return view('livewire.admin.yayasan-list', [
            'yayasans' => $yayasans,
            'pendingCount' => $pendingCount,
        ]);
    }
}
