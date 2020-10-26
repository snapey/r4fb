<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;

class EmailHistory extends Model
{
    protected $guarded=[];

    protected $table='email_history';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getShortSubjectAttribute()
    {
        return Str::limit($this->subject,30);
    }

    public function getShortBodyAttribute()
    {
        return Str::limit($this->body, 30);
    }

    public function getMarkedBodyAttribute()
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($this->body);
    }

}


