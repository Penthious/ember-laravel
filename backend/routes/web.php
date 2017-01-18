<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// API routes come first

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ( $api ) {
    header('Access-Control-Allow-Origin: http://localhost:4200');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, PATCH, DELETE');

    // API
    $api->group(['namespace' => 'App\Http\Controllers\Api'], function ( $api ) {
        // Auth
        $api->post('auth/login', 'Auth\AuthController@postLogin');
        $api->post('auth/token-refresh', 'Auth\AuthController@refreshToken');
        $api->post('users', 'Auth\UsersController@store');

        // Protected methods (require auth)
        $api->group(['middleware' => 'api.auth'], function ( $api ) {

        });

        // Public methods
    });
});

// Catchall - Displays Ember app
Route::any('{catchall}',function(){
    return view('index');
})->where('catchall', '(.*)');
