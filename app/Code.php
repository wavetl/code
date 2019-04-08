<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public static $iconMapping = [
        'php' => '<span class="text-primary mr-1"><i class="fab fa-php"></i> PHP</span>',
        'python' => '<span class="text-danger mr-1"><i class="fab fa-python"></i> Python</span>',
        'js' => '<span class="text-success mr-1"><i class="fab fa-js"></i> JavaScript</span>',
        'css' => '<span class="text-info mr-1"><i class="fab fa-css"></i> CSS</span>',
    ];

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
        return app('Carbon')->createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }

    public function is_author()
    {
        return app('auth')->id() === $this->user_id;
    }

    public static function getCodeList($args)
    {
        $codes = app('code')::with(['user']);
        if (isset($args['language'])) {
            $codes->where('language', $args['language']);
        }
        if (isset($args['user_id'])) {
            $codes->where('user_id', $args['user_id']);
        }
        $codes->orderBy('created_at', 'DESC');
        return $codes->paginate(config()->get('app.per_page'));
    }
}
