<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address1',
        'address2',
        'address3',
        'address4',
        'postcode',
        'latitude',
        'longitude',
        'phone_number',
        'addressable_id',
        'addressable_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'addressable_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class);
    }

    public function setCoordinatesAttribute($value)
    {
        $coords = explode(',',$value);
        $this->attributes['latitude'] = $coords[0];
        $this->attributes['longitude'] = $coords[1];
    }
}
