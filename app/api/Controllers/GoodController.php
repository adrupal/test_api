<?php

namespace App\Api\Controllers;

use App\Good;
use Illuminate\Http\Request;
use DB;

class GoodController extends BaseController
{
    /**
     * @SWG\Get(
     *     path="/goods",
     *     description="获取所有商品列表",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Goods"},
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     * @SWG\Post(
     *     path="/goods",
     *     description="创建一个新的商品",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Goods"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="brand_id",
     *         type="integer",
     *         description="Brand id for this goods.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="category_id",
     *         type="string",
     *         description="Category id for this goods.",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="en_title",
     *         type="string",
     *         description="English title for this goods.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="cn_title",
     *         type="string",
     *         description="Chinese title for this goods.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="price",
     *         type="number",
     *         description="Sell price for this goods.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="market_price",
     *         type="string",
     *         description="Market price for this goods.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="image1",
     *         type="number",
     *         description="Image link for this goods.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="weight",
     *         type="number",
     *         description="Weight for this goods (g).",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="shipping_fee",
     *         type="number",
     *         description="Shipping fee for this goods.",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="description",
     *         type="string",
     *         description="description fee for this goods.",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="image2",
     *         type="number",
     *         description="Image2 link for this goods.",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="image3",
     *         type="number",
     *         description="Image3 link for this goods.",
     *         required=false,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="image4",
     *         type="number",
     *         description="Image4 link for this goods.",
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
     * @SWG\Get(
     *     path="/goods/{id}",
     *     description="返回指定商品详情",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Goods"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="id",
     *         type="integer",
     *         description="产品id",
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



    function lists(Request $request){
        $goods=Good::all();
        return array('message'=>'success', 'data'=>$goods, 'status_code'=>200);
    }

    function create(Request $request){
        if(!$request->brand_id){
            return array('message'=>'brand_id require', 'status_code'=>203);
        }

        if(!$request->en_title){
            return array('message'=>'en_title require', 'status_code'=>203);
        }

        if(!$request->cn_title){
            return array('message'=>'cn_title require', 'status_code'=>203);
        }

        if(!$request->price){
            return array('message'=>'price require', 'status_code'=>203);
        }

        if(!$request->market_price){
            return array('message'=>'market_price require', 'status_code'=>203);
        }

        if(!$request->image1){
            return array('message'=>'image1 require', 'status_code'=>203);
        }

        $good=Good::create([
            'brand_id'=>intval($request->brand_id),
            'category_id'=>strval($request->category_id),
            'en_title'=>$request->en_title,
            'cn_title'=>$request->cn_title,
            'price'=>$request->price,
            'market_price'=>$request->market_price,
            'image1'=>$request->image1,
            'weight'=>intval($request->weight),
            'shipping_fee'=>strval($request->shipping_fee),
            'description'=>strval($request->description),
            'image2'=>intval($request->image2),
            'image3'=>intval($request->image3),
            'image4'=>intval($request->image4),
        ]);

        return array('message'=>'success', 'status_code'=>200);
    }

    function show(Request $request){
        if(!$request->id){
            return array('message'=>'id require', 'status_code'=>203);
        }

        $good=Good::find(intval($request->id));
        if(!$good){
            return array('message'=>'not found', 'status_code'=>404);
        }

        return array('message'=>'success', 'data'=>$good, 'status_code'=>200);
    }

}