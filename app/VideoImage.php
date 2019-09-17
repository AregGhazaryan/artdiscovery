<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Video;

class VideoImage extends Model
{
    protected $casts = [
        'id' => 'string'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(
            function ($model) {
                $model->id = (string) Uuid::generate(4);
            }
        );
    }
    
    public function product()
    {
        return $this->belongsTo(Video::class);
    }
}
