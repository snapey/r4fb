<?php

namespace App\Console\Commands;

use App\Providers\SettingsInitialisationProvider;
use Illuminate\Console\Command;

class SyncSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes sure that the set of default settings is seeded in the database without impacting those already there.
    Add new settings to the SettingsInitialisationProvider';

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
        
        $allSettings = SettingsInitialisationProvider::defaults();

        $allSettings->each(function($setting,$key){
            
            if(setting($key,'It doesnt exist') == 'It doesnt exist'){
                setting([$key=>$setting]);
                $this->info("Added Setting {$key}");
            }
            setting()->save();
        });
    }
}
