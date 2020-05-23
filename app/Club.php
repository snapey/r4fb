<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}