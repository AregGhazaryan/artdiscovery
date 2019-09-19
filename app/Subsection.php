<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\Section;

class Subsection extends Model
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

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
