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
}
