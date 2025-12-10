<?php

namespace App\Livewire;

use App\Models\Donation;
use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('Make a Donation - TangCare')]
class DonationForm extends Component
{
    use WithFileUploads;
    
    // Step tracking
    public int $step = 1;
    public const TOTAL_STEPS = 3;
    
    // Step 1: Event Selection
    public ?int $eventId = null;
    public ?Event $selectedEvent = null;
    
    // Step 2: Donation Details
    public string $weight_kg = '';
    public string $description = '';
    public $photo = null;
    
    // Step 3: Delivery Method
    public string $delivery_method = 'self';

    protected $rules = [
        'eventId' => 'required|exists:events,id',
        'weight_kg' => 'required|numeric|min:0.1|max:1000',
        'description' => 'required|string|min:10|max:1000',
        'photo' => 'nullable|image|max:5120',
        'delivery_method' => 'required|in:self,courier,expedition',
    ];

    protected $messages = [
        'eventId.required' => 'Please select an event.',
        'weight_kg.required' => 'Please enter the weight.',
        'weight_kg.min' => 'Minimum weight is 0.1 kg.',
        'description.required' => 'Please describe your donation.',
        'description.min' => 'Description must be at least 10 characters.',
        'photo.max' => 'Photo must be less than 5MB.',
    ];

    public function mount(?int $event = null): void
    {
        if (!auth()->check() || !auth()->user()->isDonor()) {
            abort(403, 'Only donors can make donations');
        }
        
        if ($event) {
            $this->selectEvent($event);
        }
    }

    public function selectEvent(int $eventId): void
    {
        $event = Event::with('yayasan')
            ->active()
            ->whereHas('yayasan', fn($q) => $q->whereNotNull('verified_at'))
            ->find($eventId);
        
        if ($event) {
            $this->eventId = $eventId;
            $this->selectedEvent = $event;
        }
    }

    public function nextStep(): void
    {
        if ($this->step === 1) {
            $this->validateOnly('eventId');
        } elseif ($this->step === 2) {
            $this->validateOnly('weight_kg');
            $this->validateOnly('description');
            $this->validateOnly('photo');
        }
        
        if ($this->step < self::TOTAL_STEPS) {
            $this->step++;
        }
    }

    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function goToStep(int $step): void
    {
        // Can only go to previous steps or current step
        if ($step <= $this->step && $step >= 1) {
            $this->step = $step;
        }
    }

    public function submit(): void
    {
        $this->validate();
        
        $imagePath = null;
        if ($this->photo) {
            $imagePath = $this->photo->store('donations', 'public');
        }
        
        Donation::create([
            'user_id' => auth()->id(),
            'event_id' => $this->eventId,
            'weight_kg' => $this->weight_kg,
            'description' => $this->description,
            'delivery_method' => $this->delivery_method,
            'status' => Donation::STATUS_PENDING,
            'image_path' => $imagePath,
        ]);
        
        session()->flash('donation_success', true);
        $this->redirect(route('donations.success'), navigate: true);
    }

    public function getAvailableEventsProperty()
    {
        return Event::with('yayasan')
            ->active()
            ->whereHas('yayasan', fn($q) => $q->whereNotNull('verified_at'))
            ->latest()
            ->limit(20)
            ->get();
    }

    public function render()
    {
        return view('livewire.donation-form', [
            'availableEvents' => $this->availableEvents,
        ]);
    }
}
