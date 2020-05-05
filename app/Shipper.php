<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'modes',
    ];

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
