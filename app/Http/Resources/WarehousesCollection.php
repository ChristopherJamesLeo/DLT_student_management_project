<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\User;
use App\Models\Status;
class WarehousesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // resource မှ ဆွဲထုတ်လာသော data များအား response.data ဖြင့် ပြန်အုပ်ထားးပေးမည်
        return [
            "data" => $this -> collection -> transform(function($warehouse){ // data ဖြင့်ပြန်အုပ်ပေးမည် $this သည် $warehouse ဟူသော parameter ထဲသို့ ဝင်သွားမည်ဖြစ်ပြီး ၄င်းအား return array ထဲတွင်ပြန်သံုးရမည် 
                return [ // return ထဲတွင် array တစ်ခု ပေးရမည် 
                    // key တွင်ကြိုက်နှစ်သက်ရာ နမည်ပေးနိုင်ပြီး ၄င်းနမည်အတိုင်းပြန်ဆွဲထုတ်ရမည် 
                    "id" => $warehouse -> id, // this သည် warehouse ထဲရှိ id ကို ခေါ်မည်ဟုဆိုလိုသည် 
                    "name" => $warehouse -> name,
                    "slug" => $warehouse -> slug,
                    "status_id" => $warehouse -> status_id,
                    "user_id" => $warehouse -> user_id,
                    "created_at" => $warehouse -> created_at -> format("d-m-y"),
                    "updated_at"  => $warehouse -> updated_at -> format("d-m-y"),
                    // "user" => User::where("id",$warehouse->user_id) -> get() , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည် 
                    // "user" => User::where("id",$warehouse->user_id) -> first("name") , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည် 
                    // "user" => User::where("id",$warehouse->user_id) -> pluck("name") , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည် 
                    // "user" => User::where("id",$warehouse->user_id) -> select("id","name")->get() , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည် 
                    "user" => User::where("id",$warehouse->user_id) -> select("id","name")->first() , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည် 

                    "status" => Status::where("id",$warehouse->status_id) -> select("id","name") -> first()
                ];
            })
        ];
    }
}

// ၄င်း $this အား controller ထဲမှပြန်ခေါ်ပေးရမည်

// Resource -> Collection -> API Controller 
