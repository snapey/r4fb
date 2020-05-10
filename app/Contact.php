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
        return $this->hasMany(\App\Note::class);
    }

    /** 
     * related models
     */
    public function contactables()
    {
        return $this->hasMany(Contactable::class);
    }
}
