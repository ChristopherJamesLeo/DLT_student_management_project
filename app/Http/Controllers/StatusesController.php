<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();

        return view("statuses.index",compact("statuses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("statuses.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StatusCreateRequest $request) // request ထဲရှိ class name အား လှမ်းခေါ်ပေးရုံဖြင့် class ထဲရှီ rule များ ဝင်လာမည်ဖြစ်သည် 
    // {
    public function store(Request $request) 
        {
        $this -> validate($request,[
            "name" => "required|unique:statuses,name"
        ]);

        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်\

        $user_id = $user->id;

        $status = new Status();
        $status -> name = $request["name"];
        $status -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
        $status -> user_id = $user_id;  

        $status -> save();

        return redirect(route("statuses.index"));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
            $this -> validate($request,[
                "name" => "required|unique:statuses,name,". $id,
            ]);
    
            $user = Auth::user(); 
    
            $user_id = $user->id;
    
            $status = Status::findOrFail($id);
            $status -> name = $request["name"];
            $status -> slug = Str::slug($request["name"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည် 
            $status -> user_id = $user_id;  
    
            $status -> save();
    
            return redirect(route("statuses.index"));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);

        $status -> delete();

        return redirect()->back();
    }
}

