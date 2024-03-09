<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = "attendances";
    protected $primaryKey = "id";
    protected $fillable = [
        "classdate",
        "post_id",
        "attcode",
        "user_id"
    ];

    public function user(){
        return $this -> belongsTo(User::class); 
    }

    public function post(){
        return $this -> belongsTo(Post::class); 
    } 
    
    public function status(){
        return $this -> belongsTo(Status::class); 
    }

    // public function student(){

    //     // error code 
    //     return $this -> belongsTo(Student::class,"user_id"); // user_id သည် မိမိ အသုံးပြုမည့် forengi key အနေဖြင့် သတ်မှတ်မည်ဟုဆိုလိုခြင်းဖြစ်သည် 
    //     // attend ထဲမှ user_id ကို ယူပြီး Student table တွင်ချိတ်မည် ဟု ဆိုလိုခြင်းဖြစ်သည် 
    // }

    public function studentUrl(){
        return Student::where("user_id",$this->user_id)->gt(["students_id"])->first();
    }

    public function student($userid){

        // method 1 
        // $students = Student::where("user_id",$userid)->get();

        // // dd($students);
        
        // foreach($students as $student){
        //     // dd($student);

        //     // return $student;
        //     return $student["regnumber"];
        // }

        // -----------------

        // method 2 

        // reg number ကို pluck ဖြင့် သီးသန့်ဆွဲထုတ်ပြိး ပို့မည့်
        $students = Student::where("user_id",$userid)->get()->pluck("regnumber");

        // dd($students);
        
        foreach($students as $student){
            // dd($student);

            return $student;
        }
    }
    
}

// 
