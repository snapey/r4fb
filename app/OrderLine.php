<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $guarded=[];

    protected $table='orderlines';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getEachPoundsAttribute()
    {
        return number_format($this->each / 100, 2,".","");
    }

    public function getTotalPoundsAttribute()
    {
        return number_format($this->total / 100, 2,".","");
    }

    public function item()
    {
        return $this->belongsTo(Item::class,'code','code');
    }
}
