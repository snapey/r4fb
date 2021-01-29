<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Club extends Model
{
    use SoftDeletes, LogsActivity;

    const NAME = 'Club'; 

    protected $guarded=[];

    protected $casts = [
        'id' => 'integer',
    ];

    protected static $logAttributes = ['name', 'areas', 'group', 'district', 'deleted_at'];

    public function contacts()
    {
        return $this->morphToMany(Contact::class, 'contactable')
            ->withPivot('relationship');
    }

    public function foodbanks()
    {
        return $this->belongsToMany(Foodbank::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable')->latest();
    }

    /**
     * Scope the model, if you are a researcher, only returns foodbanks that have contacts that you are associated with
     *
     * @return void
     */
    public function scopeMyResearchClubs(Builder $builder)
    {
        if (Auth::user()->hasPermissionTo('ResearchContactsOnly')) {

            $ids = Contact::query()
                ->with('contactables')
                ->where('researcher_id', Auth::id())
                ->get()
                ->map(function($contact) {
                    return $contact->contactables->where('contactable_type', 'App\Club');
                })
                ->flatten()
                ->pluck('contactable_id');

            return $builder->whereIn('id', $ids);
        }

        return $builder;
    }
}