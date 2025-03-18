<?php

namespace App\Http\Controllers;

use App\Jobs\StudentMailBoxJob;
use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Lead;
use App\Models\Student;
use App\Models\StudentPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all();

        return view("leads.index",compact("leads"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::orderBy('name',"asc")->get();

        $countries = Country::orderBy('name',"asc")->get();
        $cities = City::orderBy('name',"asc")->get();
        return view("leads.create",compact("genders","countries","cities"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[

            "firstname" => "required",
//            "gender_id" => "required|exists,genders.id",
            "age" => "required|integer|min:13|max:45",
            "email" => "required|string|email|max:255|unique:leads",
//            "country_id" => "required|exists,countries.id",
//            "city_id" => "required|exists,cities.id",
        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်
        $user_id = $user->id;
        $lead = new Lead();

        $lead -> firstname = $request["firstname"];
        $lead -> lastname = $request["lastname"];
        $lead -> gender_id = $request["gender_id"];
        $lead -> age = $request["age"];
        $lead -> email = $request["email"];
        $lead -> country_id = $request["country_id"];
        $lead -> city_id = $request["city_id"];
        $lead -> user_id = $user_id;

        $lead -> save();

        return redirect(route("leads.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrFail($id);
        // dd($enrolls);


        return view("leads.show",["lead" => $lead]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lead = Lead::findOrFail($id);
        $genders = Gender::orderBy('name',"asc")->get();

        $countries = Country::orderBy('name',"asc")->get();
        $cities = City::orderBy('name',"asc")->get();
        return view("leads.edit")->with("lead",$lead)->with("genders",$genders)->with("countries",$countries)->with("cities",$cities);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "firstname" => "required",
//            "gender_id" => "required|exists,genders.id",
            "age" => "required|integer|min:13|max:45",
            "email" => "required|string|email|max:255|unique:leads,email,".$id,
//            "country_id" => "required|exists,countries.id",
//            "city_id" => "required|exists,cities.id",
        ]);

        
        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်
        $user_id = $user["id"]; // array သုံးလဲရသည်
        $lead = Lead::findOrFail($id);

        if($lead -> isconverted()){

            return redirect()->back()->with("error","Edition is disabled");

        }

        $lead -> firstname = $request["firstname"];
        $lead -> lastname = $request["lastname"];
        $lead -> gender_id = $request["gender_id"];
        $lead -> age = $request["age"];
        $lead -> email = $request["email"];
        $lead -> country_id = $request["country_id"];
        $lead -> city_id = $request["city_id"];
        $lead -> user_id = $user_id;

        $lead -> save();


        return redirect(route("leads.index"));
    }

    public function converttostudent(string $id){
        $lead = Lead::findOrFail($id);
        $lead -> convertToStudent();
        session()->flash("success","Pipe Successful");

        return redirect()->back();
    }

    // dashboard
    public function dashboard(Request $request){
        $totalleades = Lead::count();
        $convertedleades = Lead::where("converted",1)->count();
        $unconvertedleades = $totalleades - $convertedleades;

        $leadsources = [
            "Totla Leads" => $totalleades,
            "Converted Leads" => $convertedleades,
            "Unconverted Leades" => $unconvertedleades
        ];

        return response()->json([
            "leadsources" => $leadsources,
        ],200);

        
    }

}
