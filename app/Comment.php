<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;
use App\User;
use App\Post;

class Comment extends Model
{
  protected $table = 'comments';
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

    public function commentable()
   {
       return $this->morphTo();
   }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->morphedByMany('App\Post', 'commentable');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies(){
      return $this->hasMany(Comment::class, 'parent_id');
    }
}
