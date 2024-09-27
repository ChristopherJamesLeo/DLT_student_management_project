<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lead extends Model
{
    use HasFactory;

    protected $table = "leads";
    protected $primaryKey = "id";
    protected $fillable = [
        "leadnumber",
        "firstname",
        "lastname",
        "gender_id",
        "age",
        "email",
        "country_id",
        "city_id",
        "user_id",
        "converted",
        "student_id"

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    protected static function boot(){
        parent::boot();

        static::creating(function($lead){
            $lead -> leadnumber = self::generateleadid();
        });

    }

    protected static function generateleadid(){
        return \DB::transaction(function(){
            $lastestlead = \DB::table("leads")->orderBy("id","desc")->first();

            $lastestleadid = $lastestlead ? $lastestlead->id : 0 ;

            $newleadid = "LD".str_pad($lastestleadid+1,5,"0",STR_PAD_LEFT);

            while(\DB::table("leads")->where('leadnumber',$newleadid)->exists()){

                $lastestleadid++; // duplicate ဖြစ်နေပါက 1 ထပ်တိုးမည်ဖြစ်ပြီး အောက်တွင် overwrite လုပ်ပေးမ်ည်ဖြစ်သည်
                $newleadid = "LD".str_pad($lastestleadid+1,5,"0",STR_PAD_LEFT);
            }

            return $newleadid;
        });
    }


    // pipe line

    public function convertToStudent(){

//        Student create
        $student = Student::create([
            "firstname"=> $this -> firstname,
            "lastname"=> $this -> lastname,
            "slug"=> Str::slug($this->firstname),
            "gender_id" => $this -> gender_id,
            "age" => $this ->age,
            "email" => $this -> email,
            "country_id" => $this -> country_id,
            "city_id" => $this -> city_id,
            "user_id" => $this -> user_id
        ]);

//        create empty phone
        StudentPhone::create([
            "student_id" => $student -> id,
            "phone" => null
        ]);
//        Lead Update
        $this -> update([
            "converted" => true,
            "student_id" => $student->id,
        ]);

        return $student;
    }

    public function isconverted(){
        return $this -> converted === 1;
    }


}


