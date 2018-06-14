<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class VerifyTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        try {
            $uid=JWTAuth::parseToken()->authenticate()->id;
        } catch (TokenExpiredException $e) {
            return array('message'=>'Token Expired', 'status_code'=>403);
        } catch (TokenInvalidException $e) {
            return array('message'=>'Token Invalid', 'status_code'=>403);
        } catch (JWTException $e) {
            return array('message'=>'Token Error', 'status_code'=>403);
        }

        if(!$uid){
            return array('message'=>'No Login', 'status_code'=>403);
        }
        $user = User::find($uid);
        if(!$user){
            return array('message'=>'Not Found', 'status_code'=>404);
        }

        $request->attributes->add(['uid'=>$uid, 'user'=>$user]);
        return $next($request);
    }
}
