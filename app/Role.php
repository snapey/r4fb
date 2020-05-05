<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as SR;

class Role extends SR 
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'guard_name'];

    protected static $logName = 'user';

}
