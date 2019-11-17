<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\User;
use App\Comment;
use App\Section;

class Post extends Model
{
    protected $casts = [
    'id' => 'string'
    ];
    protected $keyType = 'string';

    protected $fillable = ['section_id', 'subsection_id'];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(
            function ($model) {
                $model->id = (string) Uuid::generate(4);
            }
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->orderBy('created_at', 'desc');
    }

    public function comment()
    {
      return $this->morphedByMany('App\Post', 'commentable');
    }

    public function section(){
      return $this->belongsTo(Section::class, 'section_id');
    }
}
