<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\Status;
use App\Models\Relative
;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactEmailNotify;


class ContactsController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data["contacts"] = Contact::all();
        // $data["contacts"] = Contact::paginate(5);

        // $data["contacts"] = Contact::filter()->searchonly()->zafirstname()->paginate(3);

        // paginartion ကို filter နှင့် search မပျက်သွားအောင် queryString ကပ်ပေးထားခြင်းဖြစ်သည်
        $data["contacts"] = Contact::filter()->searchonly()->zafirstname()->paginate(10)->withQueryString();

        // $statuses = Status::all();
        $relatives = Relative::all()->pluck("name","id")->prepend("Choose Relative"); // pluck ထဲထည့်ပေးပါက A to Z စဥ်စားပြီးသားဖြစ်သည် 

        return view("contacts.index",$data,compact("relatives"));

    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            "firstname" => "required|min:3|max:50",
            "lastname" => "max:50",
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $contact = new Contact();

        $contact -> firstname = $request["firstname"];
        $contact -> lastname = $request["lastname"];
        $contact -> birthday = $request["birthday"];
        $contact -> relative_id = $request["relative_id"];
        $contact -> user_id = $user_id;

        $contact -> save();


        // $users = User::all(); // အားလံုးပို့ရန် 

        $contactdata = [
            "firstname" => $contact -> firstname,
            "lastname" => $contact -> lastname,
            "birthday" => $contact -> birthday,
            "relative" => $contact -> relative["name"],
            "url" => url("/") # email ထဲတွင် link ေလးနှိပ်ပါက  domain linke ကို ရယူမည် လက်ရှီ project site ထဲသို့ ေရာက်လာမည် 
        ];

        Notification::send($user,new ContactEmailNotify($contactdata));

        session()->flash("success","create successful");
        return redirect(route("contacts.index"));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this -> validate($request,[
            "firstname" => "required|min:3|max:50",
            "lastname" => "max:50",
            "birthday" => "nullable" , // မထည့်လဲ အဆင်ပြေသည် 
            "relative_id" => "nullable" , // မထည့်လဲ ရသည် 
        ]);

        $user = Auth::user();
        $user_id = $user -> id;

        $contact = Contact::findOrFail($id);

         $contact -> firstname = $request["firstname"];
        $contact -> lastname = $request["lastname"];
        $contact -> birthday = $request["birthday"];
        $contact -> relative_id = $request["relative_id"];
        $contact -> user_id = $user_id;

        $contact -> save();
        session()->flash("success","Update Successful");
        return redirect(route("contacts.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $contact = Contact::findOrFail($id);

        $contact -> delete();

        session()->flash("info","Delete Successfully");

        return redirect(route("contacts.index"));
        
    }
}
