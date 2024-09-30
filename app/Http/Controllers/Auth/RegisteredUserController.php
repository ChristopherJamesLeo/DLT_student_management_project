<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Lead;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cities = City::all();
        $countries  = Country::all();
        $genders = Gender::all();
//        single step
//        return view('auth.register',compact('cities','countries','genders'));

//        multi step
        return view('auth.registerstep1', compact('cities', 'countries', 'genders'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->firstname." ".$request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user -> id){
            //create lead
            Lead::create([
                 "firstname" => $request["firstname"],
                 "lastname" => $request["lastname"],
                 "gender_id" => $request["gender_id"],
                 "age" => $request["age"],
                 "email" => $request["email"],
                 "country_id" => $request["country_id"],
                 "city_id" => $request["city_id"],
                 "user_id" => $user->id
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


//    multi form step

    public function createstep1(){
        return view('auth.registerstep1');
    }

    public function storestep1(Request $request){

        $request->validate([
            "email" => "required|email|string|max:255|unique:users,email",
            'password' => "required|string|min:8|confirmed",
        ]);
//        session()->flash() // ခဏဘဲကြာမည်ဖြစ်ပြီး သူ့အလိုလိုပျက်သွားမည်

//                                        key name       value
//        $request->session()->put("registerationdates",$request->all()); // all သည် request ထဲက အကုန်တောင်းသည်

        $request->session()->put("registerationdatas",$request->only("email","password")); // email & password ဘဲ ယူမည်
        return redirect()->route("register.step2");
    }



    public function createstep2(){
        $genders = Gender::all();
        return view('auth.registerstep2',compact('genders'));
    }

    public function storestep2(Request $request){
        $request->validate([
            "firstname" => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "gender_id" => "required",
            "age" => "required",
        ]);

//                    အုပ်စုတစ်ခုတည်းဖြစ်သောကြောင့် key name တူတူပေးရမည်
        $regdatas = $request -> session()->get('registerationdatas');
        $regdatas["lead"] = $request->only("firstname","lastname","gender_id","age");
//      session ထဲတွင်   [email,password, "lead" => [firstname,lastname,gender_id,age]] ပုံစံဖြစ်သွားမည်
        $request->session()->put("registerationdatas",$regdatas);
        return redirect()->route("register.step3");
    }


    public function createstep3(){
        $cities = City::all();
        $countries  = Country::orderBy('name','asc')->where('status_id',3)->get();
        return view('auth.registerstep3',compact('cities','countries'));
    }

    public function storestep3(Request $request){

        $request->validate([
            "country_id" => "required",
            "city_id" => "required",
        ]);

        $regdatas = $request -> session()->get('registerationdatas');

//        data မပြည့်စုံပါက ပြန်ကန်ထုတ်ရန်
        if(!$regdatas){
            return redirect()->route("register.step1")->with("error","No data found");
        }
//        contact array name အားခံပြီး ထပ်ဆင့်ပေးသည့် ျ
//        $regdatas["contact"] = $request->only("country_id","city_id");

//        တိုက်ရိုက်သွင်းပြီး တိုက်ရိုက်ခေါ်သည်
        $regdatas["country_id"] = $request->input("country_id");
        $regdatas["city_id"] = $request->input("city_id");

        $request->session()->put("registerationdatas",$regdatas);
        //      session ထဲတွင်   [email,password, "lead" => [firstname,lastname,gender_id,age],"contact"=>["country_id,city_id] ပုံစံဖြစ်သွားမည်

        $user = User::create([
            'name' => $regdatas["lead"]["firstname"]." ".$regdatas["lead"]["firstname"], // array form အရ တိုက်ရိုက်မရှိနေသောကြာ်င့ session တွင်ခေါ်ထားသော regdatas ထဲရှိ lead အခန်းထဲတွင် သိမ်းထားသည်
            'email' => $regdatas["email"],
            'password' => Hash::make($regdatas["password"]),
        ]);

//        with controller
//        if($user -> id){
//            //create lead
//            Lead::create([
//                "firstname" => $regdatas["lead"]["firstname"],
//                "lastname" => $regdatas["lead"]["lastname"],
//                "gender_id" => $regdatas["lead"]["gender_id"],
//                "age" => $regdatas["lead"]["age"],
//                "email" => $regdatas["email"],
//                "country_id" => $regdatas["contact"]["country_id"],
//                "city_id" => $regdatas["contact"]["country_id"],
//                "user_id" => $user->id
//            ]);
//        }
//      with modal
        $user->lead()->create([
            "firstname" => $regdatas["lead"]["firstname"],
            "lastname" => $regdatas["lead"]["lastname"],
            "gender_id" => $regdatas["lead"]["gender_id"],
            "age" => $regdatas["lead"]["age"],
            "email" => $regdatas["email"],
            "country_id" => $regdatas["country_id"],
            "city_id" => $regdatas["city_id"],
//            "user_id" => $user->id  // modal ကြောင့် user id အား အလိုလျှောက် ဖြည့်သါားမည်
        ]);



        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}



