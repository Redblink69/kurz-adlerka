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

Route::get('/',"Controller@home");

Route::get('/Site1', function () {
    return view('responsivita2');
});

Route::get('/Site2', function () {
    return view('responsivita3');
});
