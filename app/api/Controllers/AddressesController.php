<?php

namespace App\Api\Controllers;

use App\Address;
use App\Api\Transformers\AddressTransformer;
use App\Http\Requests\AddressesGetRequest;
use App\Http\Requests\AddressesPostRequest;
use App\Http\Requests\AddressesPutRequest;
use Illuminate\Http\Request;

class AddressesController extends BaseController
{
    /**
     * @SWG\Post(
     *     path="/addresses",
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
     *     path="/addresses",
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
     *@SWG\Get(
     *     path="/addresses/{id}",
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
     *     path="/addresses/type/{id}",
     *     description="获取登陆用户的所有收件地址",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Address"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="type_id",
     *         type="integer",
     *         description="地址类型id 1:收件地址  2:发件地址 0:全部地址" ,
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
     * @SWG\Delete(
     *     path="/addresses",
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



    function store(AddressesPostRequest $request){
        $request['uid']=$request->get('uid');
        $address=Address::create($request->all());
        return  $this->response->item($address, new AddressTransformer)->setStatusCode(200);
    }



    function update(AddressesPutRequest $request){
        Address::where('id', $request->id)->where('uid', $request->get('uid'))->update($request->all());
        $address=Address::findOrFail($request->id);
        return $this->response->item($address, new AddressTransformer);
    }



    function show(Request $request, $address_id){
        $address=Address::where('uid', $request->get('uid'))->where('id', $address_id)->first();
        if(!$address){
            return $this->response->errorNotFound();
        }
        return $this->response->item($address, new AddressTransformer);
    }


    function index(Request $request, $type){
        $addresses=Address::where('uid', $request->get('uid'));
        if($type){
            $addresses->where('type', $type);
        }
        $addresses=$addresses->paginate(20);
        return $this->response->paginator($addresses, new AddressTransformer)->setStatusCode(200);
    }


    function delete(AddressesGetRequest $request){
        Address::where('uid', $request->get('uid'))->where('id', $request->address_id)->delete();
        return array('message'=>'ok', 'status_code'=>200);
    }

}