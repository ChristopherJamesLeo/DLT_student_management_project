<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


// အားလုံးသည် ၍ controller ကို extend လုပိရသည် controller သည် main controller ဖြစ်သည် 
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // အားလုံးကို reuseable သုံးနိုင်ရန် 
    public function sendRespond($result, $message){
        $response = [
            "successful" => true,
            'data' => $result,
            "message" => $message
        ];  // data ထပ်ခံထားသောကြောင့် response.data.data နှစ်ဆင့်ဖြစ်သွားသည် 

        return response()->json($response,200);
    }

    public function sendError($errMessage,$errors=[],$code = 404){
        $response = [
            "success" => false,
            "message" => $message
        ];

        if(!empty($errors)){
            $response["data"] = $errors;
        }

        return response()->json($response,$code);
    }
}
