<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Enroll extends Model
{
    use HasFactory;
    protected $table = "enrolls";
    protected $primaryKey = "id";
    protected $fillable = [
        "image",
        "post_id",
        "user_id",
        "stage_id",
        "remark"
    ];

    public function stage(){
        return $this -> belongsTo(Stage::class);
    }
    
    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function post(){
        return $this -> belongsTo(Post::class); 
    } 

    // public function student($userid){
    public function student(){

        // method 2 

        // reg number ကို pluck ဖြင့် သီးသန့်ဆွဲထုတ်ပြိး ပို့မည့်
        // $students = Student::where("user_id",$userid)->get()->pluck("regnumber");

        // // dd($students);
        
        // foreach($students as $student){
        //     // dd($student);

        //     return $student;
        // }

        // method 3 
        // model မှ တိုက်ရိုက် userid ကို ယူလိုက်သည် 
        // $students = Student::where("user_id",$this -> user_id)->get();
        // foreach($students as $student){
        //     // dd($student);

        //     return $student;
        // }

         // method 4
        // model မှ တိုက်ရိုက် userid ကို ယူလိုက်သည် 
        // $students = Student::where("user_id",$this -> user_id)->get()->pluck("regnumber");
        // foreach($students as $student){
        //     // dd($student);

        //     return $student;
        // }

        // method 5
                        // secondary Table ,secondary table primary key,compary,primary table foreign key
        // $students = Student::join("users","users.id","=","students.user_id")->where("user_id","=",$this->user_id)->get();
        // // dd($students);

        // foreach($students as $student){
        //     // dd($student);

        //     // return $student;
        //     return $student["regnumber"];
        //     // return $students;
        // }

        // method 6 


        // method 7


        // method 8


        // method 10
        // $students = DB::table("students")
        //             ->join("users","users.id","=","students.user_id")
        //             ->where("user_id",$this -> user_id)
        //             ->get(["users.name","students.regnumber"])->pluck("regnumber")->first();

        //             // dd($students);
                    
        //             return $students;

        // method 11
        $students = DB::table("students")
        ->select("users.id","users.name","students.regnumber")
        ->join("users","users.id","=","students.user_id")
        ->where("user_id",$this -> user_id)
        ->get()->pluck("regnumber")->first();

        // dd($students);
        
        return $students;

    }

    public function studenturl(){
        return Student::where("user_id",$this -> user_id)->get(["students.id"])->first();
    }

}

