<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Shipper extends Model
{

    use LogsActivity;

    const NAME = 'Shipper'; 


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'modes',
        'phone',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected static $logAttributes = ['name', 'modes', 'phone'];

    public function contacts()
    {
        return $this->hasMany(\App\Contact::class);
    }

    public function addresses()
    {
        return $this->hasMany(\App\Address::class);
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
