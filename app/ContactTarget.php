<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactTarget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contactable_id',
        'contactable_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contactable_id' => 'integer',
    ];


    public function contact()
    {
        return $this->belongsTo(\App\Contact::class);
    }
}
