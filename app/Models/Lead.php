<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

            $newleadid = "WDF".str_pad($lastestleadid+1,5,"0",STR_PAD_LEFT);

            while(\DB::table("leads")->where('leadnumber',$newleadid)->exists()){

                $lastestleadid++; // duplicate ဖြစ်နေပါက 1 ထပ်တိုးမည်ဖြစ်ပြီး အောက်တွင် overwrite လုပ်ပေးမ်ည်ဖြစ်သည်
                $newleadid = "WDF".str_pad($lastestleadid+1,5,"0",STR_PAD_LEFT);
            }

            return $newleadid;
        });
    }


    // pipe line

    public function converttostudent($studentid){


    }
}
