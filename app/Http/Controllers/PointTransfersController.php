<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserPoint;
use App\Models\Student;
use App\Models\PointsTransfer;

class PointTransfersController extends Controller
{
    public function index()
    {
        //  ajax ဖြင့် လှမ်းခေါ်ပါက  list ကို ဆွဲထုတ်မည် လှမ်းမခေါ်ပါက view ဖြင့် blade ကို ဆွဲတင်မည်ဖြစ်သည် 

        if(request()->ajax()){ // ajax ဖြင့် request လုပ်ခဲ့သလား စစ်နိုင်သည် 
            $userpoints = UserPoint::all();
            // return view('userpoints.list',compact("userpoints")); // package list ဖိုင်ထဲသို့ ပို့ပေးမည်ဖြစ်ပြီး ၄င်း ဖိုင်အား return ဖြင့် json အား ပို့ပေးလိုက်မည်ဖြစ်သည် 
            return view('pointtransfers.list',compact("userpoints"))->render(); // render သုံးပေးလဲရသည်
        }

        return view('pointtransfers.index');

        // package index ထဲသို့ package.list ဖိုင်ထဲရှိ data များအား ajax request ထဲသို့ ထည့်ပေးလိုက်မည်ဖြစ်သည် 
        
    }

    public function transfers(Request $request){
        $request -> validate([
            "receiver_id" => "required|exists:users,id",  // ရှီနေသော user table ထဲရှိ id ဖြစ်ရမ် 
            "points" => "required|integer|min:1"
        ]);

        $sender = Auth::user();

        $receiver = User::find($request->input("receiver_id"));
        $points = $request -> input("points");

        if($sender -> userpoint -> points < $points ){
            return response()->json(["message"=>"Insufficient Point"],400);
        }

        // begin a database transaction
        \DB::beginTransaction();   // rollback ပြန်လုပ်လို့ရသည် 
        try{
            // Deduct point from sender
            $sender -> userpoint -> points -= $points;
            $sender -> userpoint -> save();

            // Add points to receiver 
            $receiver -> userpoint -> points += $points;
            $receiver->userpoint -> save();

            
            // point transaction

            PointsTransfer::create([
                "sender_id" => $sender -> id,
                "receiver_id" => $receiver -> id,
                "points" => $points
            ]);

            \DB::commit(); // db ထဲတွင် transaction တစ်ခုလုံးအောင်မြင်လား အောင်မြင်ရင် beginTrasaction ဖွင့်ထားတာကို commit နဲ့ ပြန်ပိတ်လိုက်မည် မအောင်မြင်ရင်တ‌ော့ DB ကို rollback ပြန်လု်မယ် မူလအတိုင်းပြန်ထားမယ်လို့ဆိုလိုတာ


            return response()->json(["message"=>"Point Transferred Successfully"]);

        }catch(\Exception $e){
            \DB::rollback(); // rollback the transaction in case of error occur // error တက်ရင် db ကို နောက်ပြန်ဆုတ်ပေးမယ္ 
            return response()->json(["message"=>"Error Occurred while transferring points","error" => $e ->getmessage()],500);
        }

    }
}
