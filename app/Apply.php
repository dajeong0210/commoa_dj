<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $fillable = [
        'business_docu',
        'sale_docu',
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
    ];

    protected $guarded= [
        'id',
        'business_docu',
        'sale_docu',
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
