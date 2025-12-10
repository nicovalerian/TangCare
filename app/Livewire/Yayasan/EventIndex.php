<?php

namespace App\Livewire\Yayasan;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('My Events - Yayasan Dashboard')]
class EventIndex extends Component
{
    use WithPagination;
    
    public string $search = '';
    public string $status = 'all';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $eventId): void
    {
        $yayasan = auth()->user()->yayasan;
        $event = Event::where('yayasan_id', $yayasan->id)->findOrFail($eventId);
        $event->update(['is_active' => !$event->is_active]);
    }

    public function deleteEvent(int $eventId): void
    {
        $yayasan = auth()->user()->yayasan;
        $event = Event::where('yayasan_id', $yayasan->id)->findOrFail($eventId);
        $event->delete();
        
        session()->flash('success', 'Event deleted successfully.');
    }

    public function render()
    {
        $user = auth()->user();
        
        if (!$user->isYayasan() || !$user->yayasan) {
            abort(403, 'Unauthorized');
        }
        
        $yayasan = $user->yayasan;
        
        $events = Event::where('yayasan_id', $yayasan->id)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->status === 'active', fn($q) => $q->where('is_active', true))
            ->when($this->status === 'inactive', fn($q) => $q->where('is_active', false))
            ->withCount('donations')
            ->latest()
            ->paginate(10);
        
        return view('livewire.yayasan.event-index', [
            'events' => $events,
            'yayasan' => $yayasan,
        ]);
    }
}
