<?php

// packages table အတွက်တည်ဆောက်ထားသည် 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function subscribe(Request $request){
        
    }

    public function expire(){
        return view("subscriptions.expired");
    }


}
