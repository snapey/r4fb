<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Contactable extends Pivot
{
    protected $table='contactables';
    protected $guarded=[];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }   
}
