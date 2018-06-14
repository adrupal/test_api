<?php

namespace App\Api\Controllers;

use App\Api\Transformers\GoodTransformer;
use App\File;
use App\Good;
use App\Http\Requests\GoodsPostRequest;
use Illuminate\Http\Request;
use Storage;

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



    function index(Request $request){
        $good = Good::paginate(20);
        return $this->response->paginator($good, new GoodTransformer)->setStatusCode(200);
    }

    function store(GoodsPostRequest $request){
        $good=Good::create($request->all());
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $time=time();
            $filename=$time.rand(1000, 9999).'.'.$file->getClientOriginalExtension();
            $uri=date('Ym', $time).'/'.$filename;
            Storage::put($uri, file_get_contents($file->getRealPath()));
            $image=File::create([
                'uid' => $request->get('uid'),
                'type'=>'good',
                'entity_id'=>$good->id,
                'filename' => $filename,
                'uri'=>$uri,
                'filemime'=>$file->getMimeType(),
                'filesize'=>$file->getSize(),
            ]);
        }
        return  $this->response->item($good, new GoodTransformer)->setStatusCode(200);
    }

    function show($id){
        $good = Good::findOrFail($id);
        return $this->response->item($good, new GoodTransformer);
    }

}