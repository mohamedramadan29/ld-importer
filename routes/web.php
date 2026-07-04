<?php

use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\front\SearchController;
use App\Http\Controllers\front\FavoriteController;
use Illuminate\Support\Facades\Route;


Route::controller(FrontController::class)->group(function(){
    Route::get('/', 'index')->name('front.index');
    Route::get('/about', 'about')->name('front.about');
    Route::get('/contact', 'contact')->name('front.contact');
    Route::post('/contact/submit', 'submitContact')->name('front.contact.submit');
});
Route::controller(ProductController::class)->group(function(){
    Route::get('category','category')->name('front.category');
    Route::get('category/{slug}','categoryShow')->name('front.category.show');
    Route::get('product/{slug}','product')->name('front.product');
});
Route::controller(SearchController::class)->group(function(){
    Route::get('search','index')->name('front.search');
    Route::get('search/live','live')->name('front.search.live');
});
Route::controller(FavoriteController::class)->group(function(){
    Route::get('favorites','index')->name('front.favorites');
    Route::post('favorites/toggle/{id}','toggle')->name('front.favorites.toggle');
    Route::get('favorites/count','count')->name('front.favorites.count');
});
