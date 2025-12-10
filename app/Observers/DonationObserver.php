<?php

namespace App\Observers;

use App\Models\Donation;
use App\Models\Notification;

class DonationObserver
{
    /**
     * Handle the Donation "updated" event.
     * Send notification when donation status changes.
     */
    public function updated(Donation $donation): void
    {
        // Only trigger on status change
        if (!$donation->wasChanged('status')) {
            return;
        }

        $donor = $donation->user;
        $event = $donation->event;
        $yayasan = $event->yayasan;
        $oldStatus = $donation->getOriginal('status');
        $newStatus = $donation->status;

        // Notify the donor about their donation status change
        $this->notifyDonor($donation, $donor, $event, $yayasan, $newStatus);

        // Notify yayasan owner for new pending donations
        if ($newStatus === Donation::STATUS_PENDING && $oldStatus === null) {
            $this->notifyYayasanNewDonation($donation, $yayasan, $donor);
        }
    }

    /**
     * Send notification to donor about status change.
     */
    protected function notifyDonor(Donation $donation, $donor, $event, $yayasan, string $status): void
    {
        $title = match($status) {
            Donation::STATUS_PENDING => 'Donation Submitted',
            Donation::STATUS_ACCEPTED => 'Donation Accepted! 🎉',
            Donation::STATUS_REJECTED => 'Donation Declined',
            Donation::STATUS_RECEIVED => 'Donation Received! ✅',
            default => 'Donation Update',
        };

        $body = match($status) {
            Donation::STATUS_PENDING => "Your donation of {$donation->weight_kg} kg to \"{$event->title}\" is pending review by {$yayasan->name}.",
            Donation::STATUS_ACCEPTED => "Great news! {$yayasan->name} has accepted your donation of {$donation->weight_kg} kg. Please proceed with delivery.",
            Donation::STATUS_REJECTED => "Unfortunately, {$yayasan->name} could not accept your donation." . ($donation->rejection_reason ? " Reason: {$donation->rejection_reason}" : ''),
            Donation::STATUS_RECEIVED => "Thank you! {$yayasan->name} has confirmed receipt of your {$donation->weight_kg} kg donation. You've made a difference!",
            default => "Your donation status has been updated to: {$donation->status_label}",
        };

        Notification::create([
            'user_id' => $donor->id,
            'title' => $title,
            'body' => $body,
        ]);
    }

    /**
     * Notify yayasan about a new donation.
     */
    protected function notifyYayasanNewDonation(Donation $donation, $yayasan, $donor): void
    {
        if (!$yayasan->user) {
            return;
        }

        Notification::create([
            'user_id' => $yayasan->user->id,
            'title' => 'New Donation Request! 📦',
            'body' => "{$donor->name} wants to donate {$donation->weight_kg} kg to your event. Review and accept it in your dashboard.",
        ]);
    }

    /**
     * Handle the Donation "created" event.
     */
    public function created(Donation $donation): void
    {
        $donor = $donation->user;
        $event = $donation->event;
        $yayasan = $event->yayasan;

        // Notify donor that submission was successful
        Notification::create([
            'user_id' => $donor->id,
            'title' => 'Donation Submitted 📤',
            'body' => "Your donation of {$donation->weight_kg} kg to \"{$event->title}\" has been submitted. Waiting for {$yayasan->name} to review.",
        ]);

        // Notify yayasan owner about new donation
        if ($yayasan->user) {
            Notification::create([
                'user_id' => $yayasan->user->id,
                'title' => 'New Donation Request! 📦',
                'body' => "{$donor->name} wants to donate {$donation->weight_kg} kg to \"{$event->title}\". Review and respond in your dashboard.",
            ]);
        }
    }
}
