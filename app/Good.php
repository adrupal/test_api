<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'brand_id', 'category_id', 'en_title', 'cn_title', 'price','market_price','image1','image2','image3','image4','weight','shipping_fee','description'
    ];
}
