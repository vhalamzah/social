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
      Route::get('/addFriend/{id}', 'FriendshipController@sendRequest')->name('add.friend');
      Route::get('/see/friendRequests','FriendshipController@seeRequests')->name('see.friend.requests');
      Route::get('/accept/{name}/{id}', 'FriendshipController@accept');
      Route::get('/see/friends', 'FriendshipController@friends')->name('see.friends');
      Route::get('requestRemove/{id}', 'FriendshipController@requestRemove')->name('remove.request');
      Route::get('/unfriend/{id}', function($id){
             $loggedUser = Auth::user()->id;
              DB::table('friendships')
              ->where('requester', $loggedUser)
              ->where('user_requested', $id)
              ->delete();
              DB::table('friendships')
              ->where('user_requested', $loggedUser)
              ->where('requester', $id)
              ->delete();
               return back()->with('msg', 'You are not friend with this person');
        });

       Route::get('/notifications/{id}', 'FriendshipController@notifications');


});


