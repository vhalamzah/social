<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Profile;
class ProfilesController extends Controller
{
    public function __invoke($id)
    {
          $user = User::with('profile')->findOrFail($id);

         return view('dashboard.profiles.show', compact('user'));
    }
}

/** ===============================================================  *
*
*    this controller could be used to return  a view which is        
*    intended for back-end users only, thus the dashboard profile
*    page where user can view their own profile and can be able to
*    do some changes
*
*/
