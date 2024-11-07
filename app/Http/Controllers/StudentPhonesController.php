<?php

namespace App\Http\Controllers;

use App\Models\StudentPhone;
use Illuminate\Http\Request;

class StudentPhonesController extends Controller
{
    public function destory(string $id){
        $studentphone = StudentPhone::find($id);

        $studentphone->delete();

        $student = $studentphone -> student; // method ကိုေခါ်သော်လည်း () မထည့်ရပေ
        
        if($student){
            $student -> calculateProfileScore();
        }

        session()->flash('delete', 'Student phone deleted successfully');
        return redirect()->back();
    }
}
