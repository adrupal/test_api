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
    $api->group(['namespace'=>'App\Api\Controllers', 'prefix' => '',], function($api){


        $api->group(['prefix' => '', 'middleware'=>[]], function($api){
            $api->post('register', 'UserController@register');
            $api->post('login', 'UserController@login');

            $api->get('goods', 'GoodController@index');
            $api->get('goods/{id}', 'GoodController@show');
        });

        $api->group(['prefix' => '', 'middleware'=>['token']], function($api){
            $api->post('logout', 'UserController@logout');
            $api->get('user', 'UserController@loginUser');

            $api->post('goods', 'GoodController@store');

            $api->post('addresses', 'AddressesController@store');
            $api->put('addresses', 'AddressesController@update');
            $api->get('addresses/{id}', 'AddressesController@show');
            $api->delete('addresses', 'AddressesController@delete');
            $api->get('addresses/type/{id}', 'AddressesController@index');
        });


    });
});
