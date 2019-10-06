<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','first_name','last_name', 'email', 'password', 'gender', 'address', 'agreed_to_terms', 'mobile', 'avatar', 'birthday','ip_address'
    ];

    protected $appends = ['fullname'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'string',
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

    public function getSexAttribute($gender)
    {
        return trans('registration.' . $this->gender);
    }

    public function getOnlineAttribute() {
        return ($this->last_activity > Carbon::now()->subMinutes(5) && Auth::check()) ? true : false;
    }

    public function getFullnameAttribute(){
      return $this->first_name . ' ' . $this->last_name;
    }

}
