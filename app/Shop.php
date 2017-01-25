<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'image',
        'url',
        'contact_address',
        'contact_name',
        'contact_phone',
        'contact_mobile',
        'contact_email',
    ];

    protected $guarded= [
        'user_email',
        'id',
        'image',
    ];

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
