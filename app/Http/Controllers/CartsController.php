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
        $user_id = auth()->id();

        Cart::updateOrCreate([
            "user_id" => $user_id,
            "package_id" => $request -> package_id,
            "quantity" => $request -> input('quantity'),
            // "quantity" => \DB::raw("quantity +" . $request->input("quantity")),
            "price" => $request -> input('price')
        ]);

        return response()->json(['message' => "Product added to cart successfully"]);
        
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

    public function paybypoints(Request $request){
        $user_id = auth()->id();

        $carts = Cart::where("user_id",$user_id)->get();

        $isextand = false;

        // sum of cost
        $totalcost = $carts->sum(function($cart){
            return $cart -> price * $cart -> quantity;
        });

        $packageid = $request->input("package_id");

        $package = Package::findOrFail($packageid);

        $userpoints = Userpoint::where("user_id",$user_id)->first();

        if($userpoints && $userpoints->points >= $totalcost ){

            // deduct points
            $userpoints->points -= $totalcost ;
            $userpoints -> save();

            if($user->subscription_expires_at >= Carbon::now()){

                

                $isextand = true;
                $user -> package_id = $packageid;
                // carbon::parse() သည် date အား datatype တူစေရန်ဖြစ်သည် 
                $user->subscription_expires_at = Carbon::parse($user->subscription_expires_at)->addDay($package->duration);

                $user-> save();

               
            }else{
                $isextand = false;
                $user->subscription_expires_at = Carbon::now()->addDay($package->duration);
                $user->save();
            }

            // create invoice
            // $carts->each->delete();  // each is default method  // each သည် တစ်ကြောင်းချင်းစီကို ဖျက်ပေးမည် သို့မဟုတ် where နှင့်ဖျက်လဲရသည် 
            Cart::where("user_id",$user_id)->delete();


            return response()->json(["message" => $isextand ? "Package Extended successfully" : "New package added successfully"]);
        }

        return response()->json(["message" => "Insufficient Point"],400);




    }
}
