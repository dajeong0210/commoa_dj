<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function apply() 
    {
        return $this->hasOne('App\Apply');
    }

    public function shop()
    {
        return $this->hasOne('App\Shop');
    }

    //bookmark
    public function shops()
    {
        return $this->belongsToMany('App\Shop', 'pivot_shop_user')->withTimestamps();
    }

    //like
    public function products()
    {
        return $this->belongsToMany('App\Product', 'pivot_product_user')->withTimestamps();
    }

}
