<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributionPoint extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function address()
    {
        return $this->hasOne(\App\Address::class);
    }

    public function hours()
    {
        return $this->hasMany(\App\Hour::class);
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class);
    }
}
