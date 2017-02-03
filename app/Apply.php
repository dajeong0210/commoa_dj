<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $fillable = [
        'user_email',
        'shop_name',
        'shop_url',
        'business_name',
        'business_ceo',
        'business_address',
        'business_no',
        'business_sale_no',
        'contact_name',
        'contact_email',
        'contact_mobile',
        'contact_phone',
        'business_docu',
        'sale_docu', 
    ];

    protected $guarded= [
        'id',
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
