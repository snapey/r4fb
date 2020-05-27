<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Shipper extends Model
{

    use LogsActivity;

    const NAME = 'Shipper';

    protected $appends = ['updatedForHumans'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'modes',
        'phone',
        'is_satellite',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected static $logAttributes = ['name', 'modes', 'phone','is_satellite'];

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
