<?php

namespace App\Api\Controllers;

use App\User;
use Illuminate\Http\Request;

use DB;
use Cookie;
use Illuminate\Support\Facades\Hash;
use Redirect;
use JWTAuth;

class UserController extends BaseController
{
    /**
     * @SWG\Post(
     *     path="/auth/signUp",
     *     description="用户注册",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Auth"},
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
     *     path="/auth/login",
     *     description="用户登陆",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Auth"},
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
     * @SWG\Post(
     *     path="/auth/userInfo",
     *     description="用户信息",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Auth"},
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
     *     path="/auth/logout",
     *     description="用户注销",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"Auth"},
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



    function signUp(Request $request){
        if(!$request->username){
            return array('message'=>'Username require', 'status_code'=>203);
        }

        if(User::where('name', $request->username)->first()){
            return array('message'=>'Username must be unique', 'status_code'=>203);
        }

        if(!$request->email){
            return array('message'=>'email require', 'status_code'=>203);
        }

        if(User::where('email', $request->email)->first()){
            return array('message'=>'email must be unique', 'status_code'=>203);
        }

        if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $request->email))
            return response()->json(array('message'=>'Invalid email', 'status_code'=>203));

        if(!$request->password){
            return array('message'=>'password must be unique', 'status_code'=>203);
        }

        if(strlen($request->password)<6){
            return array('message'=>'At least 6 characters', 'status_code'=>203);
        }

        if(!$request->password_confirmation){
            return array('message'=>'password confirmation must be unique', 'status_code'=>203);
        }

        if($request->password!=$request->password_confirmation){
            return array('message'=>'Inconsistent password', 'status_code'=>203);
        }

        $user=User::create([
            'name'=>$request->username,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
        ]);
        $token=JWTAuth::fromUser($user);
        return array('message'=>'success', 'token'=>$token, 'status_code'=>200);
    }

    function login(Request $request){
        if(!$request->email){
            return array('message'=>'email require', 'status_code'=>203);
        }

        if(!$request->password){
            return array('message'=>'password require', 'status_code'=>203);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return array('message'=>'User not exist', 'status_code'=>203);
        }
        if (!Hash::check($request->password, $user->password)) {
            return array('message'=>'Password error', 'status_code'=>203);
        }
        $token = JWTAuth::fromUser($user);
        return array('message'=>'success', 'token'=>$token, 'status_code'=>200);
    }

    function userInfo(Request $request){
        $uid=JWTAuth::parseToken()->authenticate()->id;
        if($uid){
            $user = User::find($uid);
            return array(
                'message'=>'success',
                'user_id'=>$user->id,
                'username'=>$user->name,
                'email'=>$user->email,
                'status_code'=>200
            );
        }

        return array('message'=>'user not found', 'status_code'=>404);
    }

    function logout(Request $request){
        auth()->logout();
        return array('message'=>'success', 'status_code'=>200);
    }


}