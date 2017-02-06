<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'order',
        'title',
        'content',
        'image',
        'url',
        'align',
        'type',
    ];

    protected $guarded= [
        'id',
    ];

    public function product()
    {
        return $this->hasMany('App\Banner');
    }
}
