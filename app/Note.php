<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Note extends Model
{
    use LogsActivity, SoftDeletes;

    protected static $logAttributes = ['memo', 'status', 'pinned'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pinned' => 'boolean',
        'notable_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function getRecentlyUpdatedAttribute()
    {
        return $this->updated_at > now()->subseconds(60);
    }
}
