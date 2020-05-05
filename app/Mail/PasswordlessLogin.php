<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class PasswordlessLogin extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $remember=null)
    {
        $this->user = $user;

        $this->link = URL::temporarySignedRoute(
                'passwordless.link', 
                now()->addHours(6), 
                ['user'=>$user,'remember'=>$remember]
            );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.passwordlessLogin');
    }
}
