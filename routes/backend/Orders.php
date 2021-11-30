<?php

// Blogs Management
Route::group(['namespace' => 'Orders'], function () {
    Route::resource('orders', 'OrdersController');

    //For DataTables
    Route::post('orders/get', 'OrdersTableController')
        ->name('orders.get');
});
