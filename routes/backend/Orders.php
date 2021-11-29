<?php

// Blogs Management
Route::group(['namespace' => 'Orders'], function () {
    Route::resource('orders', 'OrdersController', ['except' => ['show']]);

    //For DataTables
    Route::post('orders/get', 'OrdersTableController')
        ->name('orders.get');
});
