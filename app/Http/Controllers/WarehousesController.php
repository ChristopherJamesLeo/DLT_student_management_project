<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Warehouse;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;  // catch ထဲရျီ exception အားသံုးနုိင်ရန် ျ
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class WarehousesController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        $statuses = Status::whereIn("id",[3,4])->get(); 
        return view("warehouses.index",compact("warehouses","statuses"));
    }


    public function create()
    {
        $statuses = Status::whereIn("id",[3,4])->get(); // မိမိ ပို့ချင်သော id 3 နှင့် 4 သာပို့ပေးမည် 
        return view("warehouses.create",compact("statuses"));
    }


    public function store(Request $request)
    {
        // frontend မှ validate စစ်မည် 
        // $this -> validate($request,[
        //     "name" => "required|max:50|unique:warehouses,name",
        //     "status_id" => "required|in:3,4" 

        // ]);


        // $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်

        // $user_id = $user->id;

        // try {
        //     $warehouse = new Warehouse();
        //     $warehouse -> name = $request["name"];
        //     $warehouse -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
        //     $warehouse -> status_id = $request["status_id"];  
        //     $warehouse -> user_id = $user_id;  

            
    
        //     $warehouse -> save();

        //     if($warehouse){
        //         return response()->json(["status" => "success","data" => $warehouse]);
        //     }else {
        //         return response()->json(["status" => "fail","data" => $warehouse]);
        //     }
    
        // }catch(Exception $e){
        //     Log::error($e -> getMessage());
        //     return response()->json(["status"=>"failed","message"=> $e -> getMessage()]);
        // }

        // return redirect(route("warehouses.index"));

    }


    public function show(string $id)
    {
        $warehouse =Warehouse::findOrFail($id);

        return view("warehouses.show",["warehouse"=>$warehouse]);
    }


    public function edit(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $statuses = Status::whereIn("id",[3,4])->get();
        return view("warehouses.edit")->with("warehouse",$warehouse)->with("statuses",$statuses);
    }


    // public function update(Request $request, string $id)
    // {
    //     $this -> validate($request,[
    //         // method 1 
    //         // "name" => "required|max:50|unique:types,name,". $id,

    //         // method 2 -> array ဖြင့် လဲ ပေးနိုင်သည် pipe နေရာတွင် comer  ထည့်ပီး single code double code ထည့်ပေးနိုင်သည် // မှားနိုင်သည် 
    //         "name" => ["required","max:50","unique:warehouses,name,". $id],
    //         "status_id" => ["required","in:3,4"]  // 3 နှင့် 4 ဘဲ လက်ခံမည် // fontend နှင့် ချိန်ပြီးထည့်ရမည် 

    //     ]);

 

    //     $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

    //     $user_id = $user->id;

    //     try{
    //         $warehouse = Warehouse::findOrFail($id);
    //         $warehouse -> name = $request["name"];
    //         $warehouse -> slug = Str::slug($request["name"]); 
    //         $warehouse -> status_id = $request["status_id"];  
    //         $warehouse -> user_id = $user_id;  
    
    
    
    //         $warehouse -> save();
    
    //         // return redirect(route("warehouses.index"));

    //         if($warehouse){
    //             return response()->json(["status" => 'success',"data"=>$warehouse]);
    //         }else{
    //             return response()->json(["status"=>"failed","message"=>"Failed to update payment method"]);

    //         }

    //     }catch(Exception $e){
    //         Log::error($e->getMessage());
    //         return response()->json(["status"=>"failed","message"=>$e->getMessage()]);
    //     }


    // }

    // use laravel route with ajax
    
    // public function destroy(warehouse $warehouse)  // route မှ လာသော id ဖြင့် တစ်ခါတည်း data ထုတ်ပေးထားမည်ဖြစ်သည် 
    // {

    //     try{
    //         if($warehouse){
               
    //             $warehouse -> delete();


    //             return response()->json(["status"=>"success","data"=>$warehouse,"message"=> "Delete Successful"]); 

    //         }

    //         return response()->json(["status"=>"Failed","message"=>"Data Not Found"]);
    //     }catch(Exception $e){
    //         Log::error($e->getMessage());

    //         return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
    //     }
    // }

    // ---API ကြောင်းမသံုးတော့ပေ
    // public function destroy(string $id)  // route မှ လာသော id ဖြင့် တစ်ခါတည်း data ထုတ်ပေးထားမည်ဖြစ်သည် 
    // {

    //     try{
    //         $warehouse = Warehouse::where("id",$id)->delete();

    //         return Response::json($warehouse); // true or false ဘဲ return ပြန်မည် 

    //     }catch(Exception $e){
    //         Log::error($e->getMessage());

    //         return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
    //     }
    // }



    // public function warehousesstatus(Request $request){
    //     // return response()->json(["success" => "Status Change Successful"]);

    //     $warehouse = Warehouse::findOrFail($request["id"]); // id သည် update ကဲ့သို့ route ကနေမရနေသောကြောင့် request မှ id ကို သံုးပေးရမည် 

    //     // dd("hello");

    //     $warehouse -> status_id = $request["status_id"];

    //     $warehouse -> save();

    //     // success ဖြစ်ပါက response ပြန်ရန်
    //     return response()->json(["success" => "Status Change Successful".$warehouse]);
    // }

    public function fatchalldates(){
        try{

        }catch(Exception $e){
            Log::error($e->getMessage());

            return response()->json(["status"=>"Failed","message"=> $e->getMessage()]);
        }
        $warehouses = Warehouse::orderBy("id","desc")->get();
        return response()->json(["status"=>"success","data"=>$warehouses,"test" => "hello"]);
    }
}
