<?php

namespace App\Console\Commands;

use App\Microlise\TaskCollected;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Archiving extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform archiving (pruning) of records from the database';

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
        // clear tasks

        // $affected = TaskCollected::where('created_at','<',now()->subdays(setting('tasks.archiveAfter')))->delete();

        // $this->info($affected . ' rows removed from the tasks_collected table');
        // Log::info($affected . ' rows removed from the tasks_collected table');
    }
}
