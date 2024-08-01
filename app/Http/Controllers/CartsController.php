<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Package;
use App\Models\Cart;
use App\Models\Userpoint;

class CartsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user_id = $user->id;
        $carts = Cart::where('user_id',$user_id)->get();

        $totalcost = $this -> gettotalcost($carts);
        // dd($carts);
        return view('carts.index',compact("carts",'totalcost'));
    }

    public function add(Request $request){

    }

    private function gettotalcost($carts){
        $totalcost = 0;

        foreach($carts as $cart){
            $totalcost += $cart->price * $cart->quantity;
        }
        return $totalcost ;
    }

    public function remove(Request $request){
        $user = Auth::user();

        $user_id = $user->id;

        $packageid = $request->packageid;

        $cart = Cart::where("user_id",$user_id)->where("package_id",$packageid)->first();

        $cart -> delete();

        return response()->json(['message'=>'remove from cart successful']);

    }

    public function paywithpoint(Request $request){

    }
}
