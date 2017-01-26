<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vga extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'level',
    ];

    protected $guarded= [
        'id',
    ];
    
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
