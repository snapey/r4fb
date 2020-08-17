<?php

namespace App\Http\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsPanel extends Component
{
    public function render()
    {
        return view('livewire.notifications-panel')
            ->with('notifications', Auth::user()->unreadNotifications);
    }

    public function select($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->read_at = now();
        $notification->save();

        $this->redirect($notification->data['showRoute']);
    }
}
