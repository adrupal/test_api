<?php

namespace App\Api\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressesController extends BaseController
{
    /**
     * @SWG\Post(
     *     path="/addresses/add",
     *     description="登陆用户添加收件／发件人地址",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="type",
     *         type="integer",
     *         description="（0：收件，1:发件，默认收件地址）" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="mobile",
     *         type="string",
     *         description="收件人／发件人电话" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="username",
     *         type="string",
     *         description="收件人／发件人姓名" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="country",
     *         type="string",
     *         description="国家" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="state",
     *         type="string",
     *         description="省" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="city",
     *         type="string",
     *         description="市" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="district",
     *         type="string",
     *         description="区" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address1",
     *         type="string",
     *         description="地址1" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address2",
     *         type="string",
     *         description="地址2" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="apartment",
     *         type="string",
     *         description="房间号" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="zipCode",
     *         type="string",
     *         description="邮编" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="addr_default",
     *         type="integer",
     *         description="是否为默认地址（1:是；0:否）" ,
     *         required=false,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     * @SWG\Put(
     *     path="/addresses/updateAddr",
     *     description="更新登陆用户指定地址信息",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address_id",
     *         type="integer",
     *         description="要修改的地址ID" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="type",
     *         type="integer",
     *         description="（0：收件，1:发件，默认收件地址）" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="mobile",
     *         type="string",
     *         description="收件人／发件人电话" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="username",
     *         type="string",
     *         description="收件人／发件人姓名" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="country",
     *         type="string",
     *         description="国家" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="state",
     *         type="string",
     *         description="省" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="city",
     *         type="string",
     *         description="市" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="district",
     *         type="string",
     *         description="区" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address1",
     *         type="string",
     *         description="地址1" ,
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address2",
     *         type="string",
     *         description="地址2" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="apartment",
     *         type="string",
     *         description="房间号" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="zipCode",
     *         type="string",
     *         description="邮编" ,
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="addr_default",
     *         type="integer",
     *         description="是否为默认地址（1:是；0:否）" ,
     *         required=false,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     *@SWG\Post(
     *     path="/addresses/getAddr",
     *     description="获取登陆用户指定地址",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address_id",
     *         type="integer",
     *         description="要修改的地址ID" ,
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     *@SWG\Get(
     *     path="/addresses/allDeliveryAddr",
     *     description="获取登陆用户的所有收件地址",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     * @SWG\Get(
     *     path="/addresses/getAllSenderAddr",
     *     description="获取登陆用户的所有发件人地址",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     *
     * @SWG\Delete(
     *     path="/addresses/delete",
     *     description="删除登陆用户指定的地址",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="address_id",
     *         type="integer",
     *         description="要修改的地址ID" ,
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     *
     */



    function add(Request $request){
        if(!isset($request->type)){
            return array('message'=>'type require', 'status_code'=>203);
        }

        if(!in_array($request->type, array(0, 1))){
            return array('message'=>'type require 0 or 1', 'status_code'=>203);
        }

        if(!$request->mobile){
            return array('message'=>'mobile require', 'status_code'=>203);
        }


        if(!$request->username){
            return array('message'=>'username require', 'status_code'=>203);
        }

        if(!$request->country){
            return array('message'=>'country require', 'status_code'=>203);
        }

        if(!$request->state){
            return array('message'=>'state require', 'status_code'=>203);
        }

        if(!$request->city){
            return array('message'=>'city require', 'status_code'=>203);
        }

        if(!$request->address1){
            return array('message'=>'address1 require', 'status_code'=>203);
        }

        $address=Address::create([
            'type'=>$request->type,
            'uid'=>$request->get('uid'),
            'mobile'=>$request->mobile,
            'username'=>$request->username,
            'country'=>$request->country,
            'state'=>$request->state,
            'city'=>$request->city,
            'district'=>strval($request->district),
            'address1'=>$request->address1,
            'address2'=>strval($request->address2),
            'apartment'=>strval($request->apartment),
            'zipCode'=>strval($request->zipCode),
            'addr_default'=>strval($request->addr_default),
        ]);
        return array('message'=>'success', 'status_code'=>200);
    }



    function updateAddr(Request $request){

        if(!$request->address_id){
            return array('message'=>'address_id require', 'status_code'=>203);
        }

        if(!Address::where('uid', $request->get('uid'))->where('id', $request->address_id)->first()){
            return array('message'=>'not found', 'status_code'=>404);
        }

        $fields=array(
            'type',
            'uid',
            'mobile',
            'username',
            'country',
            'state',
            'city',
            'district',
            'address1',
            'address2',
            'apartment',
            'zipCode',
            'addr_default',
        );

        $update=array();
        foreach ($fields as $field){
            if(isset($request->$field))
                $update[$field]=$request->$field;
        }

        if($update){
            Address::where('id', $request->address_id)->update($update);
        }
        return array('message'=>'success', 'status_code'=>200);
    }



    function getAddr(Request $request){
        if(!$request->address_id){
            return array('message'=>'address_id require', 'status_code'=>203);
        }

        $address=Address::where('uid', $request->get('uid'))->where('id', $request->address_id)->first();
        if(!$address){
            return array('message'=>'not found', 'status_code'=>404);
        }
        return array('message'=>'success', 'data'=>$address, 'status_code'=>200);
    }


    function allDeliveryAddr(Request $request){
        $addresses=Address::where('uid', $request->get('uid'))->where('type', 0)->get();
        return array('message'=>'success', 'data'=>$addresses, 'status_code'=>200);
    }

    function getAllSenderAddr(Request $request){
        $addresses=Address::where('uid', $request->get('uid'))->where('type', 1)->get();
        return array('message'=>'success', 'data'=>$addresses, 'status_code'=>200);
    }


    function delete(Request $request){
        if(!$request->address_id){
            return array('message'=>'address_id require', 'status_code'=>203);
        }

        $address=Address::where('uid', $request->get('uid'))->where('id', $request->address_id)->first();
        if(!$address){
            return array('message'=>'not found', 'status_code'=>404);
        }
        Address::where('uid', $request->get('uid'))->where('id', $request->address_id)->delete();
        return array('message'=>'success', 'status_code'=>200);
    }

}