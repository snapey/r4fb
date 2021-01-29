<?php

namespace App;

use App\ModelTraits\FoodbankStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Foodbank extends Model
{
    use SoftDeletes, LogsActivity, FoodbankStatus;

    const NAME = 'Foodbank'; 

    protected $appends=["shortStatusForHumans"];

    protected $guarded = [];

    protected static $logAttributes = ['name', 'email', 'website', 'location', 'deleted_at', 'hours','phone1', 'charity', 'organisation'];

    protected $casts = [
        'id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function clubs()
    {
        return $this->belongsToMany(\App\Club::class);
    }

    public function getUpdatedForHumansAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    public function addresses()
    {
        return $this->morphMany('App\Address', 'addressable');
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }

    public function contacts()
    {
        return $this->morphToMany('App\Contact', 'contactable')
                    ->withPivot('relationship');
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function getShortStatusForHumansAttribute()
    {
        return $this->foodbankShortStatuses()[$this->status];
    }

    public function scopeStatusScope($query, $filter)
    {
        if($filter) {
            $query->where('status',$filter);
        }
    }

    /**
     * Scope the model, if you are a researcher, only returns foodbanks that have contacts that you are associated with
     *
     * @return void
     */
    public function scopeMyFoodbanks(Builder $builder)
    {
        if (Auth::user()->hasPermissionTo('ResearchContactsOnly')) {

            $ids = Contact::query()
                ->with('contactables')
                ->where('researcher_id', Auth::id())
                ->get()
                ->map(function ($contact) {
                    return $contact->contactables->where('contactable_type', 'App\Foodbank');
                })
                ->flatten()
                ->pluck('contactable_id');

            return $builder->whereIn('id', $ids);
        }

        return $builder;
    }
}
