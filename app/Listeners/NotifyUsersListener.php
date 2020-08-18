<?php

namespace App\Listeners;

use App\Digest;
use App\Mail\AlertMail;
use App\Notifications\GeneralAlertNotification;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NotifyUsersListener
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dump($event);
        
        // send the event to all the users that are interested.
        // except for the user that created it
        $users = User::with(['alerts'=>function($query) use($event) {
            $query->where('event', class_basename($event));
        }])->whereHas('alerts', function($query) use ($event){
            $query->where('event', class_basename($event));
        })->where('id','!=',Auth::id())
        ->get();
        
        foreach($users as $user) {

            $vias = explode(',',$user->alerts->first()->via ?? '');

            foreach($vias as $via) {
                if(method_exists($this,$via)) {
                    $this->$via($event,$user);
                }
            }

        }
    }

    public function email($event,User $user)
    {
        Mail::to($user)->queue(new AlertMail($event));
    }

    public function digest($event,User $user)
    {
        Digest::create([
            'id' => Str::uuid(),
            'type' => class_basename($event),
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
            'data' => [
                'described' => $event->described,
                'entityName' => $event->entityName,
                'entityId' => $event->entityId,
                'showRoute' => $event->showRoute,
            ],
        ]);
    }

    public function internal($event,User $user)
    {
        $user->notify(new GeneralAlertNotification($event));
    }
}

