<?php
namespace App\Api\Transformers;

use App\File;
use App\Good;
use League\Fractal\TransformerAbstract;

class GoodTransformer extends TransformerAbstract{
    public function transform(Good $good){
        $files=File::where('entity_id', $good->id)->where('type', 'good')->get();
        $file_trans=new FileTransformer;
        $images= array();
        foreach ($files as $file){
            $images[]=$file_trans->transform($file);
        }
        return [
            'id'=>$good->id,
            'brand_id'=>$good->brand_id,
            'category_id'=>$good->category_id,
            'en_title'=>$good->en_title,
            'cn_title'=>$good->cn_title,
            'price'=>$good->price,
            'market_price'=>$good->market_price,
            'images'=>$images,
            'weight'=>$good->weight,
            'shipping_fee'=>$good->shipping_fee,
            'description'=>$good->description,
        ];
    }

}