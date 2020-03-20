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

Route::group(['prefix' => 'v1'], function() {
    Route::get('task', 'Api\v1\TaskController@index');
    Route::post('task', 'Api\v1\TaskController@post');
    Route::post('task/{id}', 'Api\v1\TaskController@update');
    Route::delete('task/{id}', 'Api\v1\TaskController@delete');


    Route::get('comment?task_id', 'Api\v1\CommentController@index');
    Route::post('comment?task_id', 'Api\v1\CommentController@post');
    Route::put('comment/{id}?task_id', 'Api\v1\CommentController@update');
    Route::delete('comment/{id}?task_id', 'Api\v1\CommentController@delete');

});

