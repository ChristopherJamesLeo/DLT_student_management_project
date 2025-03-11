<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){

            // return response()->json(["message"=>"hello"],200);

            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:100",
                "email" => "required|string|email|max:100|unique:users",
                "password" => "required|string|min:8|confirmed"
            ]);

            if( $validator -> fails()){
                return response()->json($validator -> errors(), 422);
            }

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

            // $token = $user -> createToken("API Token")->accessToken;  // create token for Auth 

            return response()->json(["message"=>"User Rgistered Succesfully"],200);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            "email" => "required|string|email",
            "password" => "required|string"
        ]);

        if( $validator -> fails()){
            return response()->json($validator -> errors(), 422);
        }

        $user = User::where("email",$request->email)->first();   // data တစ်ခုတည်းလိုချင်လို့ 
                                // ဝင်လာသော password , db ထဲရှိ password 
        if(!$user || Hash::check($request->password,$user->password)){
            return response()->json(["message" => "Invalid credential"],401);
        }

        // generate token 

        // $createtoken = $user -> createToken("Personal Access Token");
        // $token = $createtoken->accessToken;

        // or 

        $token =  $user -> createToken("Personal Access Token") -> accessToken;

        return response()->json([
            "access_token" => $token,
            "token_type" => "Bearer"   // access လုပ်သောအခါ Bearer ကို ထည့်သုံးပေးရမည် 
        ],200);

    }

    public function logout(Request $request){
        $request -> user() -> token() -> revoke();

        return response()->json(["message" => "Logged Out successfully"],200);

    }
}
