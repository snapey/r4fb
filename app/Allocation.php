<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Allocation extends Model
{
    /**
     * Allocation just created, no items yet
     */
    public CONST START = 'New'; 
    
    /**
     * Allocation is in the process of being created, not yet committed
     */
    public CONST INPROGRESS = 'In Progress';

    /**
     * Allocation has been confirmed. Orders placed on suppliers etc
     */
    public CONST CONFIRMED = 'Confirmed';

    /**
     * Allocation has been shipped to the foodbank
     */
    public CONST SHIPPED = 'Shipped';

    /**
     * Allocation has been received by the Foodbank
     */
    public CONST COMPLETE = 'Complete';

    public function createdby()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function foodbank()
    {
        return $this->belongsTo(Foodbank::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }
}
