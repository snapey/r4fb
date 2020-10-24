<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BulkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $provider;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->markdown('mail.' . $this->provider->template)
            ->subject($this->provider->subject);
        Log::info($this->provider->template);
        return ;
    }
}
