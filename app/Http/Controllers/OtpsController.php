<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Services\OtpService;

class OtpsController extends Controller
{
    protected $otpservice;

    public function __construct(OtpService $otpservice){
        $this -> otpservice = $otpservice;
    }
    public function generate(){
        $userid = Auth::id();
        $getotp =  $this -> otpservice -> generateotp($userid); // otpservice class ထဲရှိ function ကိုလှမ်းခေါ်ပြီး OTP ကို ထုတ်မည်ဖြစ်သည် 

        // dd($getotp); 
        return response()->json(["message"=>"OTP generate successful",'otp' => $getotp]);
    }

    public function verify(Request $request){
        $userid = $request->input("otpuser_id");
        $otp = $request->input('otpcode');
        $isvalidotp = $this -> otpservice -> verifyotp($userid,$otp);

        if($isvalidotp){
            return response()->json(['message'=>"OTP valid"]);
        }else {
            return response()->json(['message'=>"OTP is ivalid"],400);
        }
    }

}
