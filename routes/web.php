<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

// authentication related
Auth::routes(['register' => false]);

Route::post('/passwordless', 'Auth\LoginController@passwordless')->name('passwordless.login');
Route::view('/passwordless/sent', 'auth.passwordless.sent')->name('passwordless.sent');
Route::get('/passwordless/link/{user}', 'Auth\LoginController@link')->name('passwordless.link');
Route::view('/logout', 'auth.logout')->name('logout');

//protected routes (must be logged in)
Route::middleware(['auth', 'nocache'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('admin/foodbanks','Admin\FoodbankController@index')->name('admin.foodbanks.index');

    Route::name('admin.')->group(function () {
        Route::resource('admin/users', 'Admin\UserController');
        Route::resource('admin/roles', 'Admin\RoleController');
    });

});
