<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Video extends Model
{
    protected $casts = [
        'id' => 'string'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }

    public function getTitleAttribute()
    {
        $language = app()->getLocale();
        return $this->title = $this->{'title_' . $language};
    }

    public function getDescriptionAttribute()
    {
        $language = app()->getLocale();
        return $this->description = $this->{'description_' . $language};
    }

    public function images(){
        return $this->hasMany('App\VideoImage');
    }
}
