<?php
namespace App\Api\Transformers;

use App\Good;
use League\Fractal\TransformerAbstract;

class GoodTransformer extends TransformerAbstract{
    public function transform(Good $good){
        return [
            'id'=>$good->id,
            'brand_id'=>$good->brand_id,
            'category_id'=>$good->category_id,
            'en_title'=>$good->en_title,
            'cn_title'=>$good->cn_title,
            'price'=>$good->price,
            'market_price'=>$good->market_price,
            'image1'=>$good->image1,
            'weight'=>$good->weight,
            'shipping_fee'=>$good->shipping_fee,
            'description'=>$good->description,
        ];
    }

}