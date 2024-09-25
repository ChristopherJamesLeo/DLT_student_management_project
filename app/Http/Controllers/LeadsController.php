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


        // create validatin လုပ်ခြင်းဟုခေါ်သည်
        $this -> validate($request,[
            // "regnumber" => "required|unique:leads,regnumber", // students table ထဲ၇ှီ regnumber ည်  unique ဖြစ်ရမည်
            "firstname" => "required",
//            "lastname" => "required",
            //"remark" => "max:200" // စာလံးု size ၁၀၀၀ရှိ ရမည်
        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်
        $user_id = $user->id;
        $lead = new Lead();


        // $lead -> regnumber = $request["regnumber"]; // system မှ အလိုအေလှာက်ထည့်ပေးမည်ဖြစသ်ည်
        $lead -> firstname = $request["firstname"];
        $lead -> lastname = $request["lastname"];
        $lead -> slug = Str::slug($request["firstname"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည်
        $lead -> remark = $request["remark"];
        $lead -> user_id = $user_id;  // user ၏ data ထဲမှ id အား ခေါ်ရမည်

        // echo $request["regnumber"] . $request["firstname"] .$request["lastname"]  .Str::slug($request["firstname"]).$request["remark"].$user_id;

        $lead -> save();



        return redirect(route("students.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrFail($id);
        // $enrolls = Enroll::where("user_id",$student->user_id)->get();
        $enrolls = $lead -> enrolls(); // model မှလှမ်းခေါ်လိုက်သည်
        // dd($enrolls);


        return view("students.show",["student" => $student,"enrolls"=>$enrolls]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lead = Lead::findOrFail($id);
        return view("leads.edit")->with("student",$lead);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "regnumber" => "required|unique:students,regnumber,".$id,  // update တွင် unique ဖြစ်ရမည်ဆိုသောကြောင့် အလုပ်မလုပ်သော်ည်း $id တွင်တော့ unique မဖြစ်လဲရသည် မူလ id ဝင်လာပါက update ပြုလုပ်ခွင့်ပြုမည်ဖြစသ်ည် ဟုဆိုလိုသည် (table column နောက်တွက် (comer ထားကိုထားပေးရမည် ))
            "firstname" => "required",
//            "lastname" => "required",
            "remark" => "max:1000" // စာလံးု size ၁၀၀၀ရှိ ရမည်
        ]);


        $user = Auth::user(); // log in ဝင်ထား‌သောကောင်၏ data ရယူရန်
        $user_id = $user["id"]; // array သုံးလဲရသည်
        $lead = Lead::findOrFail($id);


        $lead -> regnumber = $request["regnumber"];
        $lead -> firstname = $request["firstname"];
        $lead -> lastname = $request["lastname"];
        $lead -> slug = Str::slug($request["firstname"]);  // Str ထဲရှီ slug ဟူသော metho dထဲသို့ firstname အား ပေးမည် ၄င်းသည် route name ဖြစ်သွ းမည်ဖြစ်သည်
        $lead -> remark = $request["remark"];
        $lead -> user_id = $user_id;  // user ၏ data ထဲမှ id အား ခေါ်ရမည်

        // echo $request["regnumber"] . $request["firstname"] .$request["lastname"]  .Str::slug($request["firstname"]).$request["remark"].$user_id;

        $lead -> save();





        return redirect(route("leads.index"));
    }

}
