<?php

namespace App\Providers;

use App\Contact;
use App\Mail\BulkMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BulkMailProvider
{
    public $recipients = [];
    public $subject = '';
    public $body = '';
    public $user;

    public function subject(string $subject) 
    {
        $this->subject = $subject;
        return $this;
    }

    public function body(string $body)
    {
        $this->body = $body;
        return $this;
    }

    public function recipients(Collection $recipients)
    {
        $this->recipients = Contact::find($recipients);
        return $this;
    }

    public function send()
    {
        $this->user = Auth::user();

        $this->recipients->each(function($recipient){
            Mail::to($recipient->email1)->queue(new BulkMail($this));
        });
    }
}
