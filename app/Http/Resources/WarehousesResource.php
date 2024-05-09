<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\User;
use App\Models\Status;

class WarehousesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ // return ထဲတွင် array တစ်ခု ပေးရမည် 
            // key တွင်ကြိုက်နှစ်သက်ရာ နမည်ပေးနိုင်ပြီး ၄င်းနမည်အတိုင်းပြန်ဆွဲထုတ်ရမည် 
            "id" => $this -> id, // this သည် warehouse ထဲရှိ id ကို ခေါ်မည်ဟုဆိုလိုသည် 
            "name" => $this -> name,
            "slug" => $this -> slug,
            "status_id" => $this -> status_id,
            "user_id" => $this -> user_id,
            "created_at" => $this -> created_at -> format("d-m-y"),
            "updated_at"  => $this -> updated_at -> format("d-m-y"),
            "user" => User::where("id",$this->user_id) -> select("id","name")->first() , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည် 

            "status" => Status::where("id",$this->status_id) -> select("id","name") -> first()
        ];
    }
}

// Resource မရေးခင် Model ကို အရသ်ကြည့်ရမည် 
// API ဆွဲထုတ်ရန် 
// <!-- Rresource သည် API တွင် မိမိ ထုတ်လိုသော data ကို သတ်မှတ်ပေးနိုင်သည် -->
// <!-- php artisan make:resource WarehousesResource -->
// <!-- php artisan make:resource WarehouseCollection -->

// API ဆွဲထုတ်ရန် Controller သက်သက်တည်ဆောက်ပေးရမည်

// API များကိုစုထားရန် folder တစ်ခု ထဲထည့်ထားပေးသင့်သည် 
// php artisan make:controller Api/WarehousesController --api       // --api ဟုသုံးပေးရမည်
// route  ထဲရှီ API ထဲတွင် ရေးပေးရမည် 