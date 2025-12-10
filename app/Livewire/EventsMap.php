<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Find Events - TangCare')]
class EventsMap extends Component
{
    public string $search = '';
    public bool $onlyOngoing = true;

    public function updatedSearch(): void
    {
        $this->dispatch('markersUpdated', $this->mapData);
    }

    public function updatedOnlyOngoing(): void
    {
        $this->dispatch('markersUpdated', $this->mapData);
    }

    public function getEventsProperty()
    {
        return Event::with(['yayasan'])
            ->whereHas('yayasan', function ($query) {
                $query->whereNotNull('latitude')
                      ->whereNotNull('longitude')
                      ->whereNotNull('verified_at'); // Only verified yayasans
            })
            ->when($this->onlyOngoing, function ($query) {
                $query->ongoing();
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhereHas('yayasan', function ($yq) {
                          $yq->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('address', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->active()
            ->get();
    }

    public function getMapDataProperty()
    {
        $markers = [];
        
        foreach ($this->events as $event) {
            $yayasan = $event->yayasan;
            $markers[] = [
                'id' => $event->id,
                'lat' => (float) $yayasan->latitude,
                'lng' => (float) $yayasan->longitude,
                'title' => $event->title,
                'yayasan' => $yayasan->name,
                'address' => $yayasan->address,
                'description' => $event->description ? \Str::limit($event->description, 100) : null,
                'isOngoing' => $event->isOngoing(),
                'startDate' => $event->start_date?->format('M d, Y'),
                'endDate' => $event->end_date?->format('M d, Y'),
                'slug' => $event->slug,
            ];
        }
        
        return $markers;
    }

    public function render()
    {
        return view('livewire.events-map', [
            'events' => $this->events,
            'mapData' => $this->mapData,
        ]);
    }
}
