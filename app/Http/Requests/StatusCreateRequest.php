<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool  // authorize တွင် return false ဖြစ်နေရန် rules သည် အလုပ်လုပ်မည်မဟုတ်ပေ ထို့ကြေင့် request ကို သုံး မည်ဆိုသောကြောင့် true ပြောင်းပေးရမည် 
    {
        // return false; // rule အား ပိတ်မည် // develop လုပ်နေသည့်အချိန်တွင် false ဖြင့် ပိတ်ထားနိုင်သည် 
        return true; //ထို့ကြေင့် request ကို သုံး မည်ဆိုသောကြောင့် true ပြောင်းပေးရမည် 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array  // rules ရေးပေးရမည် 
    {
        return [
            "name" => "required|unique:statuses,name" // controller ထဲတွင်ရေးထားသောကောင်နှင့်အတူတူပင်ဖြစ်သည် 
        ];
    }
}
