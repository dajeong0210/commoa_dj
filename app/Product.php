<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'url',
        'price',
        'monitor',
        'ram',
        'ssd',
        'hdd',
        'overclock',
        'power',
        'os',
        'cpu_id',
        'vga_id',
    ];

    protected $guarded= [
        'id',
        'image',
    ];

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
        return $this->belongsToMany('App\User', 'pivot_product_user')->withTimestamps();
    }
}
