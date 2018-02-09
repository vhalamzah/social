<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Profile;

class DashboardProfileController extends Controller
{
     public function edit($user_id)
     {
         $user = User::with('profile')->findOrFail($user_id);  
         
         return view('dashboard.profiles.edit')->withUser($user);
         
         //return view('dashboard.profiles.edit')->withUser($user);
     }

     public function changeAvatar(Request $request)
     {
     	$file = $request->file('pic');
        $filename = $file->getClientOriginalName();

        $path = 'public/img';

        $file->move($path, $filename);
        $user = Auth::user()->id;

        DB::table('users')->where('id', $user)->update(['pic' => $filename]);
        //return view('profile.index');
        return back();$file = $request->file('pic');
        $filename = $file->getClientOriginalName();

        $path = 'public/img';

        $file->move($path, $filename);
        $user = Auth::user()->id;

        DB::table('users')->where('id', $user)->update(['pic' => $filename]);
        //return view('profile.index');
        return back();
     }
}
