<?php

namespace App;

use App\ModelTraits\EncryptableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use SoftDeletes, EncryptableTrait, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forenames',
        'surname',
        'title',
        'phone1',
        'phone2',
        'email1',
        'email2',
        'researcher_id',
    ];

    public $encryptable = [
        'forenames', 'phone1', 'phone2', 'email1', 'email2','title'
    ];

    protected static $logAttributes = ['forenames', 'surname', 'phone1', 'phone2', 'email1', 'email2','deleted_at','title'];

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

    public function researcher()
    {
        return $this->belongsTo(User::class, 'researcher_id');
    }

    /**
     * Scope the model, if you are a researcher, only returns contacts that you are associated with
     *
     * @return void
     */
    public function scopeMyContacts(Builder $builder)
    {
        if(Auth::user()->hasPermissionTo('ResearchContactsOnly')) {
            return $builder->where('researcher_id',Auth::id());
        }

        return $builder;

    }
}
