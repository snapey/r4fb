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

    public function foodbank()
    {
        return $this->belongsTo(Foodbank::class, 'contactable_id');
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'contactable_id');
    }
}
