<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use SoftDeletes, LogsActivity;

    const NAME = 'Supplier'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'account',
        'phone',
        'fax',
    ];

    protected static $logAttributes = ['name','account','phone','fax'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function contacts()
    {
        return $this->morphToMany(Contact::class, 'contactable')
            ->withPivot('relationship');
    }

    public function addresses()
    {
        return $this->morphMany('App\Address', 'addressable');
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function getUpdatedForHumansAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
    
}
