<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function toArray()
    {
        return parent::toArray();
    }

    public function getCreatedAtAttribute($value)
    {
        return app('Carbon')->createFromFormat('Y-m-d H:i:s',$value)->diffForHumans();
    }
}
