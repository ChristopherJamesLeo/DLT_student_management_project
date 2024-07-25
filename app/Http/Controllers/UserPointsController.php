<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

// use App\Models\Package;
use App\Models\User;
use App\Models\UserPoint;

class UserPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  ajax ဖြင့် လှမ်းခေါ်ပါက  list ကို ဆွဲထုတ်မည် လှမ်းမခေါ်ပါက view ဖြင့် blade ကို ဆွဲတင်မည်ဖြစ်သည် 

        if(request()->ajax()){ // ajax ဖြင့် request လုပ်ခဲ့သလား စစ်နိုင်သည် 
            $userpoints = UserPoint::all();
            // return view('userpoints.list',compact("userpoints")); // package list ဖိုင်ထဲသို့ ပို့ပေးမည်ဖြစ်ပြီး ၄င်း ဖိုင်အား return ဖြင့် json အား ပို့ပေးလိုက်မည်ဖြစ်သည် 
            return view('userpoints.list',compact("userpoints"))->render(); // render သုံးပေးလဲရသည်
        }

        return view('userpoints.index');

        // package index ထဲသို့ package.list ဖိုင်ထဲရှိ data များအား ajax request ထဲသို့ ထည့်ပေးလိုက်မည်ဖြစ်သည် 
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'points' => 'required|numeric',
        ]);

        UserPoint::create($request->all()); // request ထဲက အားလုံးstore လုပ်မည်

        return response()->json(['message'=>'New Points created'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userpoint = UserPoint::findOrFail($id);

        return response()->json($userpoint);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userpoint = UserPoint::findOrFail($id);
        $userpoint -> update($request->all());

        return response()->json(["message"=>"successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userpoint = UserPoint::findOrFail($id);
        $userpoint -> delete();

        // UserPoints::destroy($id);

        return response()->json(["message"=>"delete successfully"],201);
    }

}
