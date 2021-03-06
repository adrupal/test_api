<?php
namespace App\Api\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract{
    public function transform(User $user){
        return [
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'created_at'=>$user->created_at,
        ];
    }

}