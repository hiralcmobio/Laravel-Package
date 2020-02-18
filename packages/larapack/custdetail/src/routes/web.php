<?php
//dd("ji");
//Auth::routes();
Route::get('timezones/{timezone}',
    'larapack\custdetail\CustdetailController@index');

Route::get('addCustomer',
    'larapack\custdetail\CustdetailController@addCustomer');


Route::post('/postCustomer',
    'larapack\custdetail\CustdetailController@postCustomer');
