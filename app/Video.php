<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\Section;
use App\Subsection;
use App\VideoImage;

class Video extends Model
{
    protected $casts = [
        'id' => 'string'
    ];

    protected $appends = ['title', 'description'];

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

    public function getDateAttribute()
    {
      if($this->end_date){
        return $this->start_date . ' - ' . $this->end_date;
      }else{
        return $this->start_date;
      }
    }

    public function images(){
        return $this->hasMany(VideoImage::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function currency(){
      return $this->belongsTo(Currency::class);
    }

    public function subsection(){
      return $this->belongsTo(Subsection::class);
    }
}
