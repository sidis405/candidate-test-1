<?php


Route::get('/', function () {
    return view('welcome');
});

Route::resource('customers', 'CustomersController')->except('show')->middleware('auth');
Route::resource('orders', 'OrdersController')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
