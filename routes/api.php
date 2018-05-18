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

Route::post('/login', 'AuthController@login');
Route::post('/registration', 'AuthController@newUserWizard');

Route::get('/', 'ApiPostsController@index');

Route::prefix('posts')->group(function ()
{

    Route::get('/latest', 'ApiPostsController@index_latest');
    Route::get('/oldest', 'ApiPostsController@index_oldest');
    Route::post('/store', 'ApiPostsController@store');
    Route::get('/{post}', 'ApiPostsController@show');
    Route::post('/{post}/comments', 'ApiPostsController@storecomment');

});


Route::prefix('admin')->group(function ()
{

    Route::post('/{post}/updatepost', 'ApiPostsController@updatepost');

    Route::post('/{comment}/updatecomment', 'ApiPostsController@updateComment');

});


