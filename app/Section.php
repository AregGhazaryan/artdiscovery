<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\Subsection;
use App\Video;

class Section extends Model
{
    protected $casts = [
        'id' => 'string'
    ];

    protected $appends = ['title'];

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

    public function subsection(){
        return $this->hasMany(Subsection::class);
    }

    public function video(){
        return $this->hasMany(Video::class)->orderBy('start_date', 'asc');
    }
}
