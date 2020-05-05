<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foodbank extends Model
{
    use SoftDeletes;

    protected $appends = ['updatedForHumans'];

    protected $fillable = [
        'name',
        'charity',
        'organisation',
    ];

    protected $casts = [
        'id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class);
    }

    public function clubs()
    {
        return $this->hasMany(\App\Club::class);
    }

    public function getUpdatedForHumansAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
}
