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
}
