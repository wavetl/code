<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PM extends Model
{
    protected $table = 'pms';

    public function receiver() {
        return $this->belongsTo('App\User','receiver_id','id');
    }

    public function sender() {
        return $this->belongsTo('App\User','sender_id','id');
    }
}
