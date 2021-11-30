<?php

// Shippings Management
Route::group(['namespace' => 'Shippings'], function () {
    Route::resource('shippings', 'ShippingsController');
    //For DataTables
    Route::post('shippings/get', 'ShippingsTableController')->name('shippings.get');
});
