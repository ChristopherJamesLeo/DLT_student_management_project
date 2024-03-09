<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;  // catch ထဲရျီ exception အားသံုးနုိင်ရန် ျ

class PaymentmethodsController extends Controller
{
    public function index()
    {
        $paymentmethods = Paymentmethod::all();
        $statuses = Status::whereIn("id",[3,4])->get(); 
        return view("paymentmethods.index",compact("paymentmethods","statuses"));
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("paymentmethods.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|max:50|unique:paymentmethods,name",
            "status_id" => "required|in:3,4" 

        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        $paymentmethod = new Paymentmethod();
        $paymentmethod -> name = $request["name"];
        $paymentmethod -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
        $paymentmethod -> status_id = $request["status_id"];  
        $paymentmethod -> user_id = $user_id;  

        $paymentmethod -> save();

        return redirect(route("paymentmethods.index"));
    }


    public function show(string $id)
    {
        $paymentmethod =Paymentmethod::findOrFail($id);

        return view("paymentmethods.show",["paymentmethod"=>$paymentmethod]);
    }


    public function edit(string $id)
    {
        $paymentmethod = Paymentmethod::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("paymentmethods.edit")->with("paymentmethod",$paymentmethod)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            // method 1 
            // "name" => "required|max:50|unique:types,name,". $id,

            // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
            "name" => ["required","max:50","unique:paymentmethods,name,". $id],
            "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        try{
            $paymentmethod = Paymentmethod::findOrFail($id);
            $paymentmethod -> name = $request["name"];
            $paymentmethod -> slug = Str::slug($request["name"]); 
            $paymentmethod -> status_id = $request["status_id"];  
            $paymentmethod -> user_id = $user_id;  
    
    
    
            $paymentmethod -> save();
    
            // return redirect(route("paymentmethods.index"));

            if($paymentmethod){
                return response()->json(["status" => 'success',"data"=>$paymentmethod]);
            }else{
                return response()->json(["status"=>"failed","message"=>"Failed to update payment method"]);

            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }


    }

    // use laravel route with ajax
    
    public function destroy(Paymentmethod $paymentmethod)  // route မှ လာသော id ဖြင့် တစ်ခါတည်း data ထုတ်ပေးထားမည်ဖြစ်သည် 
    {

        try{
            if($paymentmethod){
               
                $paymentmethod -> delete();


                return response()->json(["status"=>"success","data"=>$paymentmethod,"message"=> "Delete Successful"]); 

            }

            return response()->json(["status"=>"Failed","message"=>"Data Not Found"]);
        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
        }
    }


    public function paymentmethodsstatus(Request $request){
        $paymentmethod = Paymentmethod::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

        $paymentmethod -> status_id = $request["status_id"];

        $paymentmethod -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return response()->json(["success" => "Status Change Successful"]);
    }
}


// 