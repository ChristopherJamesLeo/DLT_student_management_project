<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd($this -> method()); // form  မှပို့လိုက်သော method အား ထုတ်ကြည့်နိုင်သည် POST / PUT
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        // store နှင့် update သည် validate တူညီနေပါက စစ်စရာမလိုဘဲ မတူညီမှသာ POST PUT စစ်ပြီး ေပြာင်းလဲနုိင်သည် 
        if($this -> method() == "POST"){
            return [
                "post_id" => "required",
                "startdate"  => "required|date",
                "enddate"  => "required|date",
                "tag" => "required",
                "title" => "required|max:50",
                "content" => "required",
                "image" => "nullable|image|mimes:jpg,jpeg,png|max:2048"
            ];
        }elseif($this -> method() == "PUT"){
            return [
                    "post_id" => "required",
                    "startdate"  => "required|date",
                    "enddate"  => "required|date",
                    "tag" => "required",
                    "title" => "required|max:50",
                    "content" => "required",
                    "stage_id" => "required",
                    "image" => "nullable|image|mimes:jpg,jpeg,png|max:2048"
            ];
        }
        
    }


    public function attributes(){  // input တွင်ထည့်ထားေသာ name အား မိမိ နှစ်သက်ရာ စာသားဖြင့် error ထုတ်ပြလိုပါက ၄င်း name အား သတ်မှတ်ပေးနိုင်သည်
        return [
            "post_id" => "Class name is Required",
            "startdate"  => "Start Date",
            "enddate"  => "End Date",
            "tag" => "Authorized Person"
        ];
    }


    public function messages(){ // မိမိ ထုတ်ပြလိုေသာ message ိကု ထုတ်ပြနိုင်သည် 
        return [
            "post_id.required" => "Class name can't be empty",
            "startdate.required"  => "Start Date can't be empty",
            "enddate.required"  => "End Date can't be empty",
            "tag.required" => "Authorized Person must be choose"
        ];
    }
}


// php artisan make:request LeaveRequest 

