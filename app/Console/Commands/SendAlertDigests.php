<?php

namespace App\Console\Commands;

use App\Digest;
use App\Mail\AlertMailDigest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAlertDigests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r4fb:send-alert-digests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the emails to be sent containing Alert Digests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //look for any digests that are waiting to be sent
        //organise them by the userid
        //send the digest email to each user

        $digestForUsers = Digest::whereNull('emailed_at')
            ->with('notifiable')
            ->get()
            ->groupBy('notifiable_id');

        foreach($digestForUsers as $digests) {
            Mail::to($digests->first()->notifiable)->send(new AlertMailDigest($digests));
            $digests->each(function($digest){
                $digest->markAsEmailed();
            });
        }
        

    }
}
