<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paymenttype;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;  // catch ထဲရျီ exception အားသံုးနုိင်ရန် ျ
use Illuminate\Support\Facades\Log;

class PaymenttypesController extends Controller
{
    public function index()
    {
        $paymenttypes = Paymenttype::all();
        $statuses = Status::whereIn("id",[3,4])->get(); 
        return view("paymenttypes.index",compact("paymenttypes","statuses"));
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("paymenttypes.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|max:50|unique:paymenttypes,name",
            "status_id" => "required|in:3,4" 

        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        try {
            $paymenttype = new Paymenttype();
            $paymenttype -> name = $request["name"];
            $paymenttype -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
            $paymenttype -> status_id = $request["status_id"];  
            $paymenttype -> user_id = $user_id;  

            
    
            $paymenttype -> save();

            if($paymenttype){
                return response()->json(["status" => "success","data" => $paymenttype]);
            }else {
                return response()->json(["status" => "fail","data" => $paymenttype]);
            }
    
        }catch(Exception $e){
            Log::error($e -> getMessage());
            return response()->json(["status"=>"failed","message"=> $e -> getMessage()]);
        }

        // return redirect(route("paymenttypes.index"));

    }


    public function show(string $id)
    {
        $paymenttype =Paymenttype::findOrFail($id);

        return view("paymenttypes.show",["paymenttype"=>$paymenttype]);
    }


    public function edit(string $id)
    {
        $paymenttype = Paymenttype::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("paymenttypes.edit")->with("paymenttype",$paymenttype)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            // method 1 
            // "name" => "required|max:50|unique:types,name,". $id,

            // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
            "name" => ["required","max:50","unique:paymenttypes,name,". $id],
            "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        try{
            $paymenttype = Paymenttype::findOrFail($id);
            $paymenttype -> name = $request["name"];
            $paymenttype -> slug = Str::slug($request["name"]); 
            $paymenttype -> status_id = $request["status_id"];  
            $paymenttype -> user_id = $user_id;  
    
    
    
            $paymenttype -> save();
    
            // return redirect(route("paymenttypes.index"));

            if($paymenttype){
                return response()->json(["status" => 'success',"data"=>$paymenttype]);
            }else{
                return response()->json(["status"=>"failed","message"=>"Failed to update payment method"]);

            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }


    }

    // use laravel route with ajax
    
    public function destroy(Paymenttype $paymenttype)  // route မှ လာသော id ဖြင့် တစ်ခါတည်း data ထုတ်ပေးထားမည်ဖြစ်သည် 
    {

        try{
            if($paymenttype){
               
                $paymenttype -> delete();


                return response()->json(["status"=>"success","data"=>$paymenttype,"message"=> "Delete Successful"]); 

            }

            return response()->json(["status"=>"Failed","message"=>"Data Not Found"]);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
        }
    }


    public function paymenttypesstatus(Request $request){
        $paymenttype = Paymenttype::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

        $paymenttype -> status_id = $request["status_id"];

        $paymenttype -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return response()->json(["success" => "Status Change Successful"]);
    }
}
