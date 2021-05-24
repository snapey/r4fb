<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded =[];

    public CONST START = 'Draft';
    public CONST ORDERED = 'Ordered';
    public CONST CONFIRMED = 'Confirmed';
    public CONST RECEIVED = 'Received';
    
    public function orderlines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function shipto()
    {
        return $this->belongsTo(Address::class, 'shipto_id','id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }

    public function allocations()
    {
        return $this->belongsToMany(Allocation::class);
    }
}
