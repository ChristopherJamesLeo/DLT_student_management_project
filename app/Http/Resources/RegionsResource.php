<?php

namespace App\Http\Resources;

use App\Models\Country;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ["id" => $this -> id, // this သည် warehouse ထဲရှိ id ကို ခေါ်မည်ဟုဆိုလိုသည်
            "name" => $this -> name,
            "slug" => $this -> slug,
            "country_id" => $this -> country_id,
            "city_id" => $this -> city_id,
            "status_id" => $this -> status_id,
            "user_id" => $this -> user_id,
            "created_at" => $this -> created_at -> format("d-m-y"),
            "updated_at"  => $this -> updated_at -> format("d-m-y"),
            "user" => User::where("id",$this->user_id) -> select("id","name")->first() , // user ၏ data များပါ condition စစ်ပြီးဆွဲထုတ်နိုင်သည်
            "country" => Country::where("id",$this->country_id)->select("id","name")->first(),
            "status" => Status::where("id",$this->status_id) -> select("id","name") -> first()
        ];
    }
}
