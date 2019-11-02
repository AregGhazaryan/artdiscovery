<?php
use App\User;
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

// Auth::routes(['verify' => true]);

Route::get('/', 'PagesController@index')->name('home');
Route::get('/sections', 'PagesController@sections')->name('sections');
Route::post('/getVideos', 'VideoController@getVideos');
Route::post('/getVideo', 'VideoController@getVideo');
Route::get('/video/{id}', 'PagesController@video')->name('page.video');
Route::get('/events', 'EventController@index')->name('events.index');
Route::get('/events/get', 'EventController@getAll')->name('events.get');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@sendMail')->name('send-mail');

Route::middleware('admin')->group(function () {
    Route::post('/events', 'EventController@store')->name('events.store');
    Route::get('/events/create', 'EventController@create')->name('events.create');
    Route::get('/events/list', 'EventController@lists')->name('events.list');
    Route::get('/events/{id}/edit', 'EventController@edit')->name('events.edit');
    Route::put('/events/{id}/update', 'EventController@update')->name('events.update');
    Route::get('/events/{id}/delete', 'EventController@destroy')->name('events.destroy');
    Route::resource('videos', 'VideoController');
    Route::post('/uploadImg', 'VideoController@imageUpload');
    Route::post('/uploadEventImg', 'EventController@imageUpload');
    Route::get('/user/{id}/ban', 'UserController@ban')->name('user.ban');
    Route::get('/user/{id}/unban', 'UserController@unban')->name('user.unban');
    Route::get('/user/{id}/setauthor', 'UserController@setAuthor')->name('user.set-author');
    Route::get('/user/{id}/unsetauthor', 'UserController@unsetAuthor')->name('user.unset-author');

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
  Route::post('/post', 'PostController@store')->name('post.store')->middleware('can:create,App\Post');
  Route::put('/post/{id}/update', 'PostController@update')->name('post.update');
  Route::get('/post/{id}/edit', 'PostController@edit')->name('post.edit');
  Route::delete('/post/{id}/delete', 'PostController@destroy')->name('post.destroy');
  Route::post('/uploadPostImg', 'PostController@imageUpload')->middleware('can:create,App\Post');
  Route::resource('comment', 'CommentController');

    // Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');
    Route::resource('profile', 'ProfileController');
    Route::resource('users', 'UserController');
    Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');
});

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@store']);

Auth::routes();

Route::get('/sections', function () {
    return view('maintance.underconstruction');
})->name('sections');

Route::get('/video/{id}', function () {
    return view('maintance.underconstruction');
})->name('page.video');
