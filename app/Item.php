<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'sku',
        'uom',
        'weight',
        'description',
        'durability',
        'generic',
        'each',
        'pounds',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'generic' => 'boolean',
    ];


    public function suppliers()
    {
        return $this->hasMany(\App\Supplier::class);
    }

    public function costs()
    {
        return $this->hasMany(\App\Costs::class);
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }

    public function setPoundsAttribute($value)
    {
        $this->each = intval($value*100);
    }

    public function getPoundsAttribute()
    {
        return number_format($this->each/100,2);
    }

}
