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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function(){

	Route::get('/test', function () {
    return Auth::user()->test();
});

	 Route::get('/home', 'HomeController@index')->name('home');
     Route::get('/profile/{id}', 'ProfilesController')->name('dashboard.profile');
     Route::get('/profile/{id}/edit', 'DashboardProfileController@edit')->name('edit.dashboard.profile');

     Route::get('/change/avatar', function () 
     {
     	return view('dashboard.profiles.profilePic');
     });
      Route::post('upload/avatar','DashboardProfileController@changeAvatar')->name('edit.profile.pic');
      Route::get('find/friends', 'FriendshipController@findFriends')->name('find.friends');

});


