<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tags = Tag::all();

        // pagination ဖြင့် ထုတ်ရန် 
        // $tags = Tag::paginate(5); // paginate တွင်ပြမည့်အရေအတွက်
        $tags = Tag::orderby("id","asc")->paginate(5); // paginate တွင်ပြမည့်အရေအတွက်

        $statuses = Status::whereIn("id",["3","4"])->get();
        // $statuses = Status::all();

        return view("tags.index",compact("tags"))->with("statuses",$statuses);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "name" => "required|unique:tags,name"
        ]);

        $user_id = Auth::user() -> id ;

        $tag = new Tag();
        $tag -> name = $request["name"];
        $tag -> slug = Str::slug($request["name"]);
        $tag -> user_id = $user_id;
        $tag -> status_id = $request["status_id"];

        $tag -> save();

        return redirect(route("tags.index"));
    }


    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "name" => "required|unique:tags,name,".$id,
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $tag = Tag::findOrFail($id);

        $tag -> name = $request["name"];
        $tag -> slug = Str::slug($request["name"]);
        $tag -> user_id = $user_id;
        $tag -> status_id = $request["status_id"];

        $tag -> save();

        return redirect(route("tags.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        $tag -> delete();

        return redirect(route("tags.index"));

        
    }

    // change status
    public function tagstatus(Request $request){

        $tag = Tag::findOrFail($request["id"]);

        $tag-> status_id = $request["status_id"];
        
        $tag -> save();

        return response()->json(["success" => "Status Change Successful"]);
    }
}
