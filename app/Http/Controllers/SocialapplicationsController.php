<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Socialapplication;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;  // catch ထဲရျီ exception အားသံုးနုိင်ရန် ျ
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class SocialapplicationsController extends Controller
{
    public function index()
    {
        $socialapplications = Socialapplication::all();
        $statuses = Status::whereIn("id",[3,4])->get(); 
        return view("socialapplications.index",compact("socialapplications","statuses"));
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("socialapplications.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        // frontend မှ validate စစ်မည် 
        // $this -> validate($request,[
        //     "name" => "required|max:50|unique:socialapplications,name",
        //     "status_id" => "required|in:3,4" 

        // ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        $user_id = $user->id;

        try {
            $socialapplication = new Socialapplication();
            $socialapplication -> name = $request["name"];
            $socialapplication -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
            $socialapplication -> status_id = $request["status_id"];  
            $socialapplication -> user_id = $user_id;  

            
    
            $socialapplication -> save();

            if($socialapplication){
                return response()->json(["status" => "success","data" => $socialapplication]);
            }else {
                return response()->json(["status" => "fail","data" => $socialapplication]);
            }
    
        }catch(Exception $e){
            Log::error($e -> getMessage());
            return response()->json(["status"=>"failed","message"=> $e -> getMessage()]);
        }

        // return redirect(route("socialapplications.index"));

    }


    public function show(string $id)
    {
        $socialapplication =Socialapplication::findOrFail($id);

        return view("socialapplications.show",["socialapplication"=>$socialapplication]);
    }


    public function edit(string $id)
    {
        $socialapplication = Socialapplication::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("socialapplications.edit")->with("socialapplication",$socialapplication)->with("statuses",$statuses);
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            // method 1 
            // "name" => "required|max:50|unique:types,name,". $id,

            // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
            "name" => ["required","max:50","unique:socialapplications,name,". $id],
            "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

        ]);

 

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        try{
            $socialapplication = Socialapplication::findOrFail($id);
            $socialapplication -> name = $request["name"];
            $socialapplication -> slug = Str::slug($request["name"]); 
            $socialapplication -> status_id = $request["status_id"];  
            $socialapplication -> user_id = $user_id;  
    
    
    
            $socialapplication -> save();
    
            // return redirect(route("socialapplications.index"));

            if($socialapplication){
                return response()->json(["status" => 'success',"data"=>$socialapplication]);
            }else{
                return response()->json(["status"=>"failed","message"=>"Failed to update payment method"]);

            }

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
        }


    }

    // use laravel route with ajax
    
    // public function destroy(Socialapplication $socialapplication)  // route မှ လာသော id ဖြင့် တစ်ခါတည်း data ထုတ်ပေးထားမည်ဖြစ်သည် 
    // {

    //     try{
    //         if($socialapplication){
               
    //             $socialapplication -> delete();


    //             return response()->json(["status"=>"success","data"=>$socialapplication,"message"=> "Delete Successful"]); 

    //         }

    //         return response()->json(["status"=>"Failed","message"=>"Data Not Found"]);
    //     }catch(Exception $e){
    //         Log::error($e->getMessage());

    //         return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
    //     }
    // }

    public function destroy(string $id)  // route မှ လာသော id ဖြင့် တစ်ခါတည်း data ထုတ်ပေးထားမည်ဖြစ်သည် 
    {

        try{
            $socialapplication = Socialapplication::where("id",$id)->delete();

            return Response::json($socialapplication); // true or false ဘဲ return ပြန်မည် 

        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
        }
    }


    public function paymentmethodsstatus(Request $request){
        $socialapplication = Socialapplication::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

        $socialapplication -> status_id = $request["status_id"];

        $socialapplication -> save();

        // success ဖြစ်ပါက response ပြန်ရန်
        return response()->json(["success" => "Status Change Successful"]);
    }
}
