<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Donation Submitted - TangCare')]
class DonationSuccess extends Component
{
    public function mount(): void
    {
        // Redirect if accessed directly without submitting a donation
        if (!session()->has('donation_success')) {
            $this->redirect(route('dashboard'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.donation-success');
    }
}
