<?php

namespace App\Livewire\Yayasan;

use App\Models\Yayasan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Profile - Yayasan Dashboard')]
class Profile extends Component
{
    public ?Yayasan $yayasan = null;
    
    #[Rule('required|min:3|max:255')]
    public string $name = '';
    
    #[Rule('nullable|max:1000')]
    public string $description = '';
    
    #[Rule('required|max:500')]
    public string $address = '';
    
    #[Rule('nullable|numeric|between:-90,90')]
    public ?float $latitude = null;
    
    #[Rule('nullable|numeric|between:-180,180')]
    public ?float $longitude = null;

    public function mount(): void
    {
        $user = auth()->user();
        
        if (!$user->isYayasan()) {
            abort(403, 'Unauthorized');
        }
        
        $this->yayasan = $user->yayasan;
        
        if ($this->yayasan) {
            $this->name = $this->yayasan->name;
            $this->description = $this->yayasan->description ?? '';
            $this->address = $this->yayasan->address;
            $this->latitude = $this->yayasan->latitude;
            $this->longitude = $this->yayasan->longitude;
        }
    }

    public function save(): void
    {
        $this->validate();
        
        $user = auth()->user();
        
        if ($this->yayasan) {
            // Update existing
            $this->yayasan->update([
                'name' => $this->name,
                'description' => $this->description ?: null,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);
        } else {
            // Create new yayasan for this user
            $this->yayasan = Yayasan::create([
                'user_id' => $user->id,
                'name' => $this->name,
                'description' => $this->description ?: null,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);
        }
        
        session()->flash('success', 'Profile saved successfully!');
    }

    public function render()
    {
        return view('livewire.yayasan.profile');
    }
}
