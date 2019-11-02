<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Page extends Model
{
    protected $casts = [
    'id' => 'string'
    ];
    protected $keyType = 'string';

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

    public function getNameAttribute(){
      $language = app()->getLocale();
      return $this->title = $this->{'title_' . $language};
    }

    public function getDetailsAttribute(){
      $language = app()->getLocale();
      return $this->description = $this->{'description_' . $language};
    }
}
