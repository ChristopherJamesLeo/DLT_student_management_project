<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UsersFollwerController extends Controller
{
    public function follow(User $user){
        $curloginuser = Auth::user();  // login ဝင်ထားသောသူကို ရရှိပြီ
        $curloginuser->followings()->attach($user); 
        
        session()->flash("success","Followed Successfully");

        return redirect()->back();
    }

    public function unfollow(User $user){
        $curloginuser = Auth::user();  // login ဝင်ထားသောသူကို ရရှိပြီ
        $curloginuser->followings()->detach($user);  // ပြန်ဖျက်မည်
        
        session()->flash("success","UnFollowed Successfully");

        return redirect()->back();
    }

    
}
