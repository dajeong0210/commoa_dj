<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function cpu()
    {
        return $this->belongsTo('App\Cpu');
    }

    public function vga()
    {
        return $this->belongsTo('App\Vga');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'pivot_category_product')->withTimestamps();
    }

    //like
    public function users()
    {
        return $this->belonsToMany('App\User', 'pivot_product_user')->withTimestamps();
    }
}
