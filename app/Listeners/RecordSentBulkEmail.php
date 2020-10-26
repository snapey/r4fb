<?php

namespace App\Listeners;

use App\EmailHistory;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordSentBulkEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        EmailHistory::create([
            'subject' => $event->subject,
            'body' => $event->body,
            'pdf' => $event->pdf,
            'user_id' => $event->sender,
            'queued_at' => Carbon::parse($event->queued_at),
        ]);
    }
}
