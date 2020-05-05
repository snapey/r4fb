<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'opens',
        'closes',
        'day',
        'accessible_id',
        'accessible_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'accessible_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
