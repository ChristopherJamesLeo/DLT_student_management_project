<?php

namespace App\Http\Controllers;

use App\Models\StudentPhone;
use Illuminate\Http\Request;

class StudentPhonesController extends Controller
{
    public function destory(string $id){

        
        $studentphone = StudentPhone::find($id);

        $student = $studentphone -> student;
        // check if profile lock 
        if($student -> isProfileLock()){
            return redirect()->back()->with("error","Profile Locked, please contact to admin");
        }


        $studentphone->delete();

        $student = $studentphone -> student; // method ကိုေခါ်သော်လည်း () မထည့်ရပေ
        
        if($student){
            $student -> calculateProfileScore();
        }

        session()->flash('delete', 'Student phone deleted successfully');
        return redirect()->back();
    }
}
