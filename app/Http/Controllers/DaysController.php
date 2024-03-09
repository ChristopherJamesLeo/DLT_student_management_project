<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Day;
use App\Models\Status;

class DaysController extends Controller
{
    public function index()
    {
        $days = Day::all();

        // $statuses = Status::all();
        $statuses = Status::whereIn("id",[3,4])->get();

        return view("days.index",compact("days"))->with("statuses",$statuses);
    }


    public function store(Request $request)
    {
        // $this -> validate($request,[
        //     "name" => "required|unique:days,name"
        // ]);

        $this -> validate($request,[
            "name" => "required|unique:days,name",
            "status_id" => "required|in:3,4"
        ],[ // error message ထုတ်ပြချင်သည့် စာသားအားပြောင်းလဲရန် seconde para ဖြင့် ရေးပေးရမည် 
            'name.required' => "Day Name Is Required"  // name အား error message ထုတ်ပြသည့် နေရာ ကို ေပြာင်းသည် 
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $day = new Day();

        $day -> name = $request["name"];
        $day -> slug = Str::slug($request["name"]);
        $day -> user_id = $user_id;
        $day -> status_id = $request["status_id"];

        $day -> save();

        return redirect(route("days.index"));

    }



    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "name" => "required|unique:days,name,".$id,
            "status_id" => "required|in:3,4"
        ],[
            'name.required' => "Day Name Is Required"
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $day = Day::findOrFail($id);

        $day -> name = $request["name"];
        $day -> slug = Str::slug($request["name"]);
        $day -> user_id = $user_id;
        $day -> status_id = $request["status_id"];

        $day -> save();

        return redirect(route("days.index"));
    }

    public function destroy(string $id)
    {
        $day = Day::findOrFail($id);

        $day -> delete();

        return redirect(route("days.index"));
    }


    // ajax
    public function daystatus(Request $request){

        $day = Day::findOrFail($request["id"]);

        $day -> status_id = $request["status_id"];

        $day->save();

        return response()->json(["success"=>"status change successful"]);
    }
}


// change every require name