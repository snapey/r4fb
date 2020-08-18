<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    public const PLANNED    = 'Planned';
    public const RECEIVED   = 'Received';
    public const CANCELLED  = 'Cancelled';

    public function allocations()
    {
        return $this->belongsToMany(Allocation::class)->withPivot('sub');
    }

    public function fromAddress()
    {
        return $this->belongsTo(Address::class, 'from_id', 'id');
    }

    public function toAddress()
    {
        return $this->belongsTo(Address::class, 'to_id', 'id');
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')
            ->orderBy('pinned', 'desc')
            ->latest();
    }

    public function scopeStatusScope($query, $filter)
    {
        if ($filter) {
            $query->where('status', $filter);
        }
    }
    
}
