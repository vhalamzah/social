<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
class FriendshipController extends Controller
{
    public function findFriends() {

        $uid = Auth::user()->id;
        $allUsers =User::with('profile')->where('users.id', '!=', $uid)->get();

        return view('dashboard.friends.show', compact('allUsers'));
    }
}
