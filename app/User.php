<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile',
    ];

    protected static $logAttributes = ['name', 'email', 'password', 'passwordless','deleted_at', 'mobile'];

    protected static $logName = 'user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    // public function routeNotificationForNexmo($notification)
    // {
    //     if(Str::startsWith($this->mobile,'07')){
    //         return substr_replace($this->mobile,'447',0,2);
    //     }
    //     return false;
    // }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function selectorColumns()
    {
        return ['id', 'name'];
    }

    public function searchColumn()
    {
        return 'name';
    }

    public function getIdentifierAttribute()
    {
        return $this->name;
    }

}
