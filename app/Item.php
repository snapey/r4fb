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
}