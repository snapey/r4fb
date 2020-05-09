<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foodbank extends Model
{
    use SoftDeletes;

    const NAME = 'Foodbank'; 

    protected $appends = ['updatedForHumans'];

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function clubs()
    {
        return $this->hasMany(\App\Club::class);
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

}
