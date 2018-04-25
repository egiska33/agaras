<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

// Route::group(['middleware' => ['auth:api']], function () {
    // Route::get('/testtt', function (Request $request) {
    //      return response()->json(Auth::user());
    // });
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd("S");
    // return $request->user();
});

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes

    // Route::get('/myAccount', function()
    // {
    //     dd(Auth::user());
    // });
    Route::get('/myAccount', function()
    {
        dd(Auth::user());
    });
});
