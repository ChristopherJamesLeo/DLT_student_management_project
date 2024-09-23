<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReligionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $religions = Religion::all();

        return view("religions.index",compact("religions"));
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
        $this -> validate($request,[
            "name" => "required|unique:religions,name"
        ]);

        $user_id = Auth::user() -> id;

        $religion = new Religion();

        $religion -> name = $request["name"];
        $religion -> slug = Str::slug($request["name"]);
        $religion -> user_id = $user_id;

        $religion -> save();

        return redirect(route("religions.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $this -> validate($request,[
            "name" => "required|unique:religions,name"
        ]);

        $user_id = Auth::user() -> id;

        $religion = Religion::findOrFail($id);

        $religion -> name = $request["name"];
        $religion -> slug = Str::slug($request["name"]);
        $religion -> user_id = $user_id;

        $religion -> save();

        return redirect() -> back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $religion = Religion::findOrFail($id);

        $religion -> delete();

        return redirect() -> back();
    }
}
