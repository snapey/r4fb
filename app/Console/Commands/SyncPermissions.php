<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Permission;
use Spatie\Permission\PermissionRegistrar;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes sure that the set of available permissions is up to date';

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
        
        $allPermissions = Permission::allPermissions();

        // remove any permissions that are no longer valid

        Permission::all()->each(function ($existing) use ($allPermissions) {
            if (!$allPermissions->contains($existing->name)) {
                $existing->delete();
                $this->info("Removed Permission: {$existing->name}");
            }
        });

        // add new permissions
        
        $allPermissions->each(function($perm){
            
            $model = Permission::updateOrCreate(['name'=>$perm]);
            
            if($model->wasRecentlyCreated) {
                $this->info("Added Permission: {$perm}");
            }
        });


        
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
