<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * @date blade directive 
         * use as @date($object->datefield) 
         * or with a format @date($object->datefield,'m/d/Y')
         */
        Blade::directive('date', function ($expression) {
            $default = "'d-m-Y H:i'";           //set default format if not present in $expression
            
            $parts = str_getcsv($expression);
            $parts[1] = (isset($parts[1]))?$parts[1]:$default;
            return '<?php if(' . $parts[0] . '){ echo e(' . $parts[0] . '->format(' . $parts[1] . ')); } ?>';
        });

    }
}
