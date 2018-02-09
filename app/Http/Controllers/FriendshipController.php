<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profile;
use Auth;
use App\Friendship;
use App\Notification;

class FriendshipController extends Controller
{
    public function findFriends() {

/*        $uid = Auth::user()->id;


        $allUsers =User::with('profile')->findOrFail($uid)->where('users.id', '!=', $uid)->get();
*/
        $uid = Auth::user()->id;
        $allUsers = DB::table('profiles')
        ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
        ->where('users.id', '!=', $uid)->get();

        return view('dashboard.friends.show', compact('allUsers'));
    }

    public function sendRequest($id)
    {
    	Auth::user()->addFriend($id);

       return back();
    }

    public function seeRequests()
    {
        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.requester')
                        ->where('status', '=', Null)
                        ->where('friendships.user_requested', '=', $uid)->get();


        return view('dashboard.friends.seeFriendRequests', compact('FriendRequests'));
    }

      public function accept($name, $id)
      {
        $uid = Auth::user()->id;
        $checkRequest = Friendship::where('requester', $id)
                ->where('user_requested', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";

        $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

           $notifcations = new Notification;
            $notifcations->note = 'accepted your friend request';
            $notifcations->user_hero = $id; // who is accepting my request
            $notifcations->user_logged = Auth::user()->id; // me
            $notifcations->status = '1'; // unread notifications
            $notifcations->save();


            if ($notifcations) {

                return back()->with('msg', 'You are now Friend with ' . $name);
            }
        } else {
            return back()->with('msg', 'You are now Friend with this user');
        }
    }
    public function friends() {
        $uid = Auth::user()->id;

        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('requester', $uid) // who is loggedin
                ->get();

        //dd($friends1);

        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested', $uid)
                ->get();

        $friends = array_merge($friends1->toArray(), $friends2->toArray());

        return view('dashboard.friends.friends', compact('friends'));
    }

    public function requestRemove($id) {

        DB::table('friendships')
                ->where('user_requested', Auth::user()->id)
                ->where('requester', $id)
                ->delete();

        return back()->with('msg', 'Request has been deleted');
    }

    public function notifications($id) {

         $uid = Auth::user()->id;
         $notes = DB::table('notifications')
                ->leftJoin('users', 'users.id', 'notifications.user_logged')
                ->where('notifications.id', $id)
                ->where('user_hero', $uid)
                ->orderBy('notifications.created_at', 'desc')
                ->get();

         $updateNoti = DB::table('notifications')
                     ->where('notifications.id', $id)
                    ->update(['status' => 0]);

       return view('dashboard.notifications.notify', compact('notes'));
    }
}
