<?php

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

Route::get('/', 'PagesController@index')->name('home');
Route::get('/sections', 'PagesController@sections')->name('sections');
Route::post('/getVideos', 'VideoController@getVideos');
Route::post('/getVideo', 'VideoController@getVideo');
Route::get('/video/{id}', 'PagesController@video')->name('page.video');

Route::middleware('admin')->group(function () {
    Route::resource('videos', 'VideoController');
    Route::post('/uploadImg', 'VideoController@imageUpload');

    Route::prefix('admin')->group(function () {
        Route::resource('sections', 'SectionController');
        Route::resource('subsections', 'SubsectionController');
        Route::get('/users', 'UserController@Index')->name('admin.users.index');
        Route::get('/videos/create', 'VideoController@create')->name('admin.videos.create');
        Route::post('/videos/store', 'VideoController@store')->name('admin.videos.store');
        Route::get('/videos/{id}/edit', 'VideoController@edit')->name('admin.videos.edit');
        Route::put('/videos/{id}/update', 'VideoController@update')->name('admin.videos.update');
        Route::delete('/videos/{id}/delete', 'VideoController@destroy')->name('admin.videos.delete');
        Route::get('/videos', 'VideoController@AdminVideos')->name('admin.videos.adminIndex');
        Route::get('purchases', 'AdminController@purchaseHistory')->name('admin.purchases');
    });

    Route::get('/admin', 'AdminController@index')->name('cpanel');

});

Route::middleware('auth')->group(function () {

    Route::get('/videos', function () {
        // Uses first & second Middleware
    });

    Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');
    Route::resource('users', 'UserController');
});

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@store']);

Route::get('/contact', 'PagesController@contact');
Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/sections', function () {
    return view('maintance.underconstruction');
})->name('sections');

Route::get('/video/{id}', function () {
    return view('maintance.underconstruction');
})->name('page.video');
