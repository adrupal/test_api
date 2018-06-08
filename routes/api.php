<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace'=>'App\Api\Controllers'], function($api){


        $api->group(['prefix' => '', 'middleware'=>[]], function($api){
            $api->post('auth/signUp', 'UserController@signUp');
            $api->post('auth/login', 'UserController@login');
            $api->get('goods', 'GoodController@lists');
            $api->get('goods/{id}', 'GoodController@show');
        });

        $api->group(['prefix' => '', 'middleware'=>['token']], function($api){
            $api->post('auth/logout', 'UserController@logout');
            $api->post('auth/userInfo', 'UserController@userInfo');
            $api->post('goods', 'GoodController@create');

            $api->post('addresses/add', 'AddressesController@add');
            $api->put('addresses/updateAddr', 'AddressesController@updateAddr');
            $api->post('addresses/getAddr', 'AddressesController@getAddr');
            $api->get('addresses/allDeliveryAddr', 'AddressesController@allDeliveryAddr');
            $api->get('addresses/getAllSenderAddr', 'AddressesController@getAllSenderAddr');
            $api->delete('addresses/delete', 'AddressesController@delete');
        });


    });
});
