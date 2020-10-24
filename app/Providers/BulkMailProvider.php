<?php

namespace App\Providers;

use App\Contact;
use App\Mail\BulkMail;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BulkMailProvider
{
    public $recipients = [];
    public $users = [];
    public $subject = '';
    public $body = '';
    public $user;
    public $pdf;
    public $template = 'bulkmail';

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

    public function users(Collection $users)
    {
        $this->users = User::find($users);
        return $this;
    }

    public function pdf($pdf)
    {
        $this->pdf = $pdf;
        return $this;
    }

    public function template($template)
    {
        $this->template = $template;
        return $this;
    }

    public function send()
    {
        $this->user = Auth::user();

        $this->recipients->each(function($recipient){
            Mail::to($recipient->email1)->queue(new BulkMail($this));
        });

        $this->users->each(function ($user) {
            Mail::to($user->email)->queue(new BulkMail($this));
        });
    }
}
