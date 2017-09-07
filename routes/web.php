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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin',function(){
    return view("admin");
});
Route::get('test','TestController@index');
Route::get('qrcode','TestController@qrcode');
Route::get('testpdf','TestController@testpdf');
Route::get('transaction','TestController@transaction');
Route::get('excel','TestController@excel');