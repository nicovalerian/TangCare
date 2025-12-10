<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NotificationBell extends Component
{
    public bool $isOpen = false;

    /**
     * Toggle the notification dropdown.
     */
    public function toggleDropdown(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    /**
     * Close the dropdown.
     */
    public function closeDropdown(): void
    {
        $this->isOpen = false;
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead(int $notificationId): void
    {
        $notification = Notification::where('user_id', auth()->id())
            ->find($notificationId);
        
        if ($notification) {
            $notification->markAsRead();
        }
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): void
    {
        Notification::where('user_id', auth()->id())
            ->unread()
            ->update(['is_read' => true]);
    }

    /**
     * Get unread count.
     */
    #[Computed]
    public function unreadCount(): int
    {
        if (!auth()->check()) {
            return 0;
        }
        
        return Notification::where('user_id', auth()->id())
            ->unread()
            ->count();
    }

    /**
     * Get recent notifications.
     */
    #[Computed]
    public function notifications()
    {
        if (!auth()->check()) {
            return collect();
        }
        
        return Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
