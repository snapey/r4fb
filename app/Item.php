<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

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
        $this->each = strval($value*100);
    }

    public function setNetPoundsAttribute($value)
    {
        $this->net = strval($value * 100);
    }

    public function getPoundsAttribute()
    {
        return number_format($this->each/100,2);
    }

    public function getNetPoundsAttribute()
    {
        return number_format($this->net/100,2);
    }

    public function scopeRecentForGuests($query)
    {
        if(Auth::check()){
            return;
        }
        return $query->where('updated_at','>',today()->subDays(22));
    }


    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function itemStatuses()
    {
        return [
            'approved' => 'Approved',
            'approvedvatless' =>'Approved,No VAT',
            'vatapproved' => 'Approved with VAT',
            'unapproved' => 'Unapproved',
            'newtoday' => 'New Today',
        ];
    }
}
