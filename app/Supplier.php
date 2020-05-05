<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

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

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
