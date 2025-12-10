<?php

namespace App\Livewire\Yayasan;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class EventForm extends Component
{
    public ?Event $event = null;
    public bool $isEditing = false;
    
    #[Rule('required|min:3|max:255')]
    public string $title = '';
    
    #[Rule('nullable|max:2000')]
    public string $description = '';
    
    #[Rule('nullable|date')]
    public ?string $start_date = null;
    
    #[Rule('nullable|date|after_or_equal:start_date')]
    public ?string $end_date = null;
    
    public bool $is_active = true;

    public function mount(?int $id = null): void
    {
        $user = auth()->user();
        
        if (!$user->isYayasan() || !$user->yayasan) {
            abort(403, 'Unauthorized');
        }
        
        if ($id) {
            $this->event = Event::where('yayasan_id', $user->yayasan->id)->findOrFail($id);
            $this->isEditing = true;
            
            $this->title = $this->event->title;
            $this->description = $this->event->description ?? '';
            $this->start_date = $this->event->start_date?->format('Y-m-d');
            $this->end_date = $this->event->end_date?->format('Y-m-d');
            $this->is_active = $this->event->is_active;
        }
    }

    public function getTitle(): string
    {
        return $this->isEditing ? 'Edit Event - TangCare' : 'Create Event - TangCare';
    }

    public function save(): void
    {
        $this->validate();
        
        $user = auth()->user();
        $yayasan = $user->yayasan;
        
        $data = [
            'title' => $this->title,
            'description' => $this->description ?: null,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
            'is_active' => $this->is_active,
        ];
        
        if ($this->isEditing) {
            $this->event->update($data);
            session()->flash('success', 'Event updated successfully!');
        } else {
            $data['yayasan_id'] = $yayasan->id;
            Event::create($data);
            session()->flash('success', 'Event created successfully!');
        }
        
        $this->redirect(route('yayasan.events'), navigate: true);
    }

    public function render()
    {
        return view('livewire.yayasan.event-form');
    }
}
