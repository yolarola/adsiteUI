<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers;
use App\Http\Controllers\AdvertController;
//use App\Http\Controllers\CategoryController;
use App\Models\Category;
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
Route::resource('categories',CategoryController::class);
//Route::get('/', function () {
    //return view('home');
//});

//Route::get('/advert', function () {
  //  return view('advert');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

Route::post('/profile', [App\Http\Controllers\UserController::class, 'update_avatar'])->name('update_avatar');



Route::get('/advert', [App\Http\Controllers\AdvertController::class, 'advert']);

Route::post('/advert-store', [App\Http\Controllers\AdvertController::class, 'AdvertStore'])->name('AdvertStore');

//Route::get('/advert-category', [App\Http\Controllers\CategoryController::class, 'AdvertCategory'])->name('AdvertCategory');




Route::get('/dropdown', [App\Http\Controllers\DropdownController::class, 'index']);
Route::get('/dropdown-data', [App\Http\Controllers\DropdownController::class, 'data']);

Route::post('/dropdown-req', [App\Http\Controllers\DropdownController::class, 'req']);

//Route::get('/adminpanel', [App\Http\Controllers\UserController::class, 'adminpanel'])->name('adminpanel');

Route::get('/adminpanel', [App\Http\Controllers\UserController::class, 'adminpanel'])->name('adminpanel');

Route::get('/adminpanel/all', [App\Http\Controllers\UserController::class, 'adminpanelall']);

Route::get('/adminpanel/edit/{advert}', [App\Http\Controllers\UserController::class, 'adminpaneledit'])->name('adminpaneledit');

Route::get('/adminpanel/delete/{advert}', [App\Http\Controllers\AdvertController::class, 'adminpaneldelete'])->name('adminpaneldelete');

Route::get('/adminpanel/aprove/{advert}', [App\Http\Controllers\AdvertController::class, 'adminpanelaprove'])->name('adminpanelaprove');

Route::post('/adminpanel/edit', [App\Http\Controllers\AdvertController::class, 'AdvertUpdate'])->name('AdvertUpdate');

Route::post('/profile-update', [App\Http\Controllers\UserController::class, 'UserUpdate'])->name('UserUpdate');

Route::get('/show/{advert}', [App\Http\Controllers\HomeController::class, 'homeshow'])->name('homeshow');

Route::get('/messages/all', [App\Http\Controllers\MessageController::class, 'messagesall'])->name('messagesall');

Route::get('/messages/show/{id}', [App\Http\Controllers\MessageController::class, 'messagesshow'])->name('messagesshow');

Route::post('/messages/show/{id}', [App\Http\Controllers\MessageController::class, 'sendmessage'])->name('sendmessage');