<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public CONST DRAFT = 'Draft';
    public CONST PURCHASING = 'Purchasing';

    public $guarded=[];
    
    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
