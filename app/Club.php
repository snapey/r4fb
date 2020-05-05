<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'areas',
        'group',
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

    public function foodbanks()
    {
        return $this->hasMany(\App\Foodbank::class);
    }

    public function notes()
    {
        return $this->hasMany(\App\Note::class);
    }
}
