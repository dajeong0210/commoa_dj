<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    //bookmark
    public function users()
    {
        return $this->belongsToMany('App\User', 'pivot_shop_user')->withTimestamps();
    }
}
