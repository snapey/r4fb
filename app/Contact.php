<?php

namespace App;

use App\ModelTraits\EncryptableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes, EncryptableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forenames',
        'surname',
        'phone1',
        'phone2',
        'email1',
        'email2',
    ];

    public $encryptable = [
        'forenames', 'phone1', 'phone2', 'email1', 'email2'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')->latest();
    }

    /** 
     * related models
     */
    public function contactables()
    {
        return $this->hasMany(Contactable::class);
    }

    public function foodbanks()
    {
        return $this->morphedByMany('App\Foodbank', 'contactable')->withPivot('relationship');
    }

    public function clubs()
    {
        return $this->morphedByMany('App\Club', 'contactable')->withPivot('relationship');
    }

    public function shippers()
    {
        return $this->morphedByMany('App\Shipper', 'contactable')->withPivot('relationship');
    }

    public function suppliers()
    {
        return $this->morphedByMany('App\Supplier', 'contactable')->withPivot('relationship');
    }
}
