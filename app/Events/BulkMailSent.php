<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class BulkMailSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subject;
    public $body;
    public $pdf;
    public $excel;
    public $sender;
    public $recipient;
    public $queued_at;

    public function __construct($bulkmail, $email, $sender)
    {
        $this->subject = $bulkmail->subject;
        $this->body = $bulkmail->body;
        $this->pdf = $bulkmail->pdf;
        $this->sender = $sender;
        $this->recipient = $email;
        $this->queued_at = now()->timestamp;
        $this->excel = $bulkmail->excelurl;
    }

}
