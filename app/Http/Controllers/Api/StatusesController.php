<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Status;
use App\Http\Resources\StatusesResource;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all(); // paginate ပေးပါက web controller ထဲတွင်ပါ paginate ထည့်ပေးရမည်

        // dd($statuses);

        return StatusesResource::collection($statuses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Search by filter 
    public function search(Request $request)
    {
        $query = $request -> input("query");

        if($query){
            $statuses = Status::where("name","LIKE","%{$query}%")->get();
        }else{
            $statuses = Status::all(); 
        }

        return StatusesResource::collection($statuses);
    }
    // end search by filter
}


// php artisan make:controller Api/Controller --api 
// php artisan make:resource StatusesResource