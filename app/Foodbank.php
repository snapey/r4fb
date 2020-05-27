<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Foodbank extends Model
{
    use SoftDeletes, LogsActivity;

    const NAME = 'Foodbank'; 

    protected $appends = ['updatedForHumans'];

    protected $guarded = [];

    protected static $logAttributes = ['name', 'email', 'website', 'location', 'deleted_at', 'hours','phone1', 'charity', 'organisation'];

    protected $casts = [
        'id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function clubs()
    {
        return $this->belongsToMany(\App\Club::class);
    }

    public function getUpdatedForHumansAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function addresses()
    {
        return $this->morphMany('App\Address', 'addressable');
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }

    public function contacts()
    {
        return $this->morphToMany('App\Contact', 'contactable')
                    ->withPivot('relationship');
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
}
