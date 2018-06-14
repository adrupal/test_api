<?php
namespace App\Api\Transformers;

use App\Address;
use League\Fractal\TransformerAbstract;

class AddressTransformer extends TransformerAbstract{
    public function transform(Address $address){
        return [
            'id'=>$address->id,
            'uid'=>$address->uid,
            'type'=>$address->type,
            'mobile'=>$address->mobile,
            'username'=>$address->username,
            'country'=>$address->country,
            'state'=>$address->state,
            'city'=>$address->city,
            'district'=>$address->district,
            'address1'=>$address->address1,
            'address2'=>$address->address2,
            'apartment'=>$address->apartment,
            'zipCode'=>$address->zipCode,
            'addr_default'=>$address->addr_default,
            'created_at'=>$address->created_at,
        ];
    }

}