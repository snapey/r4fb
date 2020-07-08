<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

// authentication related
Auth::routes(['register' => false]);

Route::post('/passwordless', 'Auth\LoginController@passwordless')->name('passwordless.login');
Route::view('/passwordless/sent', 'auth.passwordless.sent')->name('passwordless.sent');
Route::get('/passwordless/link/{user}', 'Auth\LoginController@link')->name('passwordless.link');
Route::view('/logout', 'auth.logout')->name('logoutview');

//protected routes (must be logged in)
Route::middleware(['auth', 'nocache'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('admin/foodbanks','Admin\FoodbankController@index')->name('admin.foodbanks.index');
    Route::get('admin/foodbanks/create','Admin\FoodbankController@create')->name('admin.foodbanks.create');
    Route::get('admin/foodbanks/{foodbank}','Admin\FoodbankController@show')->name('admin.foodbanks.show');

    Route::get('admin/contacts', 'Admin\ContactController@index')->name('admin.contacts.index');
    Route::get('admin/contacts/create', 'Admin\ContactController@create')->name('admin.contacts.create');
    Route::get('admin/contacts/{contact}', 'Admin\ContactController@show')->name('admin.contacts.show');

    Route::get('admin/clubs', 'Admin\ClubController@index')->name('admin.clubs.index');
    Route::get('admin/clubs/create', 'Admin\ClubController@create')->name('admin.clubs.create');
    Route::get('admin/clubs/{club}', 'Admin\ClubController@show')->name('admin.clubs.show');

    Route::get('admin/suppliers', 'Admin\SupplierController@index')->name('admin.suppliers.index');
    Route::get('admin/suppliers/create', 'Admin\SupplierController@create')->name('admin.suppliers.create');
    Route::get('admin/suppliers/{supplier}', 'Admin\SupplierController@show')->name('admin.suppliers.show');

    Route::get('admin/shippers', 'Admin\ShipperController@index')->name('admin.shippers.index');
    Route::get('admin/shippers/create', 'Admin\ShipperController@create')->name('admin.shippers.create');
    Route::get('admin/shippers/{shipper}', 'Admin\ShipperController@show')->name('admin.shippers.show');

    Route::get('admin/items', 'Admin\ItemController@index')->name('admin.items.index');
    Route::get('admin/items/create', 'Admin\ItemController@create')->name('admin.items.create');
    Route::get('admin/items/show/{item}', 'Admin\ItemController@show')->name('admin.items.show');

    Route::name('admin.')->group(function () {
        Route::resource('admin/users', 'Admin\UserController');
        Route::resource('admin/roles', 'Admin\RoleController');
    });

    Route::get('allocations', 'AllocationsController@index')->name('allocations.index');
    Route::get('allocations/create', 'AllocationsController@create')->name('allocations.create');
    Route::get('allocations/{allocation}', 'AllocationsController@show')->name('allocations.show');

    Route::get('prepareOrders', 'PrepareOrdersController@show')->name('prepare-orders');

    Route::get('orders', 'PurchaseOrderController@index')->name('orders.index');
    Route::get('orders/{order}', 'PurchaseOrderController@show')->name('orders.show');
    Route::get('orders/{order}/pdf', 'PurchaseOrderController@pdf')->name('orders.pdf');
    Route::post('purchase/create', 'PurchaseOrderController@create')->name('orders.create');
    Route::patch('purchase/{order}/marksent', 'PurchaseOrderController@marksent')->name('orders.marksent');


});
