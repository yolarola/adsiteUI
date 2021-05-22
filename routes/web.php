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

Route::get('/myads', [App\Http\Controllers\UserController::class, 'myads'])->name('myads');



Route::get('/advert', [App\Http\Controllers\AdvertController::class, 'advert']);

Route::post('/advert-store', [App\Http\Controllers\AdvertController::class, 'AdvertStore'])->name('AdvertStore');

//Route::get('/advert-category', [App\Http\Controllers\CategoryController::class, 'AdvertCategory'])->name('AdvertCategory');




Route::get('/dropdown', [App\Http\Controllers\DropdownController::class, 'index']);
Route::get('/dropdown-data', [App\Http\Controllers\DropdownController::class, 'data']);

Route::post('/dropdown-req', [App\Http\Controllers\DropdownController::class, 'req']);

//Route::get('/adminpanel', [App\Http\Controllers\UserController::class, 'adminpanel'])->name('adminpanel');

Route::get('/adminpanel', [App\Http\Controllers\UserController::class, 'adminpanel'])->name('adminpanel');

Route::get('/adminpanel/all', [App\Http\Controllers\UserController::class, 'adminpanelall'])->name('adminpanelall');

Route::get('/adminpanel/edit/{advert}', [App\Http\Controllers\UserController::class, 'adminpaneledit'])->name('adminpaneledit');

Route::post('/adminpanel/edit-imagemain', [App\Http\Controllers\AdvertController::class, 'admin_ImageUpdate_main'])->name('admin_ImageUpdate_main');
Route::post('/adminpanel/edit-image2', [App\Http\Controllers\AdvertController::class, 'admin_ImageUpdate_2'])->name('admin_ImageUpdate_2');
Route::post('/adminpanel/edit-image3', [App\Http\Controllers\AdvertController::class, 'admin_ImageUpdate_3'])->name('admin_ImageUpdate_3');
Route::post('/adminpanel/edit', [App\Http\Controllers\AdvertController::class, 'admin_MyadUpdate'])->name('admin_MyadUpdate');

Route::get('/adminpanel/delete/{advert}', [App\Http\Controllers\AdvertController::class, 'adminpaneldelete'])->name('adminpaneldelete');

Route::get('/home/{id}', [App\Http\Controllers\AdvertController::class, 'adminhomedelete'])->name('adminhomedelete');

Route::get('/adminpanel/aprove/{advert}', [App\Http\Controllers\AdvertController::class, 'adminpanelaprove'])->name('adminpanelaprove');

//Route::post('/adminpanel/edit', [App\Http\Controllers\AdvertController::class, 'AdvertUpdate'])->name('AdvertUpdate');

Route::post('/profile-update', [App\Http\Controllers\UserController::class, 'UserUpdate'])->name('UserUpdate');

Route::get('/show/{advert}', [App\Http\Controllers\HomeController::class, 'homeshow'])->name('homeshow');

Route::get('/messages/all', [App\Http\Controllers\MessageController::class, 'messagesall'])->name('messagesall');

Route::get('/messages/show/{id}/{advert}', [App\Http\Controllers\MessageController::class, 'messagesshow'])->name('messagesshow');

Route::post('/messages/show/{id}', [App\Http\Controllers\MessageController::class, 'sendmessage'])->name('sendmessage');


Route::get('/myads/delete/{advert}', [App\Http\Controllers\UserController::class, 'addelete'])->name('addelete');

Route::get('/myads/edit/{advert}', [App\Http\Controllers\UserController::class, 'adedit'])->name('adedit');

Route::post('/myads/edit', [App\Http\Controllers\AdvertController::class, 'MyadUpdate'])->name('MyadUpdate');

Route::post('/myads/edit-imagemain', [App\Http\Controllers\AdvertController::class, 'ImageUpdate_main'])->name('ImageUpdate_main');

Route::post('/myads/edit-image2', [App\Http\Controllers\AdvertController::class, 'ImageUpdate_2'])->name('ImageUpdate_2');

Route::post('/myads/edit-image3', [App\Http\Controllers\AdvertController::class, 'ImageUpdate_3'])->name('ImageUpdate_3');

Route::get('/autocomplete', [App\Http\Controllers\AdvertController::class, 'autocomplete'])->name('autocomplete');

Route::get('/search', [App\Http\Controllers\AdvertController::class, 'search'])->name('search');
Route::get('/categorysearch', [App\Http\Controllers\AdvertController::class, 'categorysearch'])->name('categorysearch');