<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use SoftDeletes;

    const NAME = 'Club'; 

    protected $guarded=[];

    protected $casts = [
        'id' => 'integer',
    ];


    public function contacts()
    {
        return $this->morphToMany(Contact::class, 'contactable')
            ->withPivot('relationship');
    }

    public function foodbanks()
    {
        return $this->hasMany(Foodbank::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable')->latest();
    }
}