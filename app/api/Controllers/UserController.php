<?php

namespace App\Api\Controllers;

use App\Api\Transformers\UserTransformer;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Redirect;
use JWTAuth;

class UserController extends BaseController
{
    /**
     * @SWG\Post(
     *     path="/register",
     *     description="用户注册",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="username",
     *         type="string",
     *         description="Username must be unique.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="email",
     *         type="string",
     *         description="Username must be unique.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="password",
     *         type="string",
     *         description="At least 6 characters.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="password_confirmation",
     *         type="string",
     *         description="At least 6 characters and same with password.",
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
     * @SWG\Post(
     *     path="/login",
     *     description="用户登陆",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         in="formData",
     *         name="email",
     *         type="string",
     *         description="User email.",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         in="formData",
     *         name="password",
     *         type="string",
     *         description="User password.",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=203,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * ),
     * @SWG\Get(
     *     path="/user",
     *     description="获取登陆用户信息",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"User"},
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
     *     path="/logout",
     *     description="用户注销",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */

    function register(RegisterRequest $request){
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
        ]);
        $token=JWTAuth::fromUser($user);
        return array('message'=>'ok', 'token'=>$token, 'status_code'=>200);
    }

    function login(LoginRequest $request){
        $user = User::where('name', $request->name)->orwhere('email', $request->name)->first();
        if(!$user){
            return $this->response->errorNotFound();
        }
        if (!Hash::check($request->password, $user->password)) {
            return array('message'=>'Password error', 'status_code'=>422);
        }
        $token = JWTAuth::fromUser($user);
        return array('message'=>'ok', 'token'=>$token, 'status_code'=>200);
    }

    function loginUser(Request $request){
        $user=$request->get('user');
        return $this->response->item($user, new UserTransformer)->setStatusCode(200);
    }

    function logout(Request $request){
        auth()->logout();
        return array('message'=>'success', 'status_code'=>200);
    }

}