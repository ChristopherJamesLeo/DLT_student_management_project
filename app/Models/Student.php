<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Student extends Model
{
    use HasFactory;

    protected $table = "students";
    protected $primaryKey = "id";
    protected $fillable = [
        "regnumber",
        "image",
        "firstname",
        "lastname",
        "slug",
        "dob",
        "gender_id",
        "age",
        "email",
        "country_id",
        "city_id",
        "region_id",
        "township_id",
        "address",
        "religion_id",
        "nationalid",
        "remark",
        "status_id",
        "user_id",
        "profile_score"

    ];

    public function user(){
        return $this -> belongsTo("App\Models\User"); // send all columns from statuses table
    }

    public function gender(){
        return $this -> belongsTo(Gender::class);
    }

    public function country(){
        return $this -> belongsTo(Country::class);
    }

    public function city(){
        return $this -> belongsTo(City::class);
    }

    public function region(){
        return $this -> belongsTo(Region::class);
    }

    public function township(){
        return $this -> belongsTo(Township::class);
    }

    public function religion(){
        return $this -> belongsTo(Religion::class);
    }

    public function status(){
        // return $this -> belongsTo(Status::class); // send all columns
        // return $this -> belongsTo(Status::class)->select("name"); // send single column
        return $this -> belongsTo(Status::class)->select(["id","name","slug"]); // send choice column from statuses table
    }

    public function enrolls(){
        $enrolls = Enroll::where("user_id",$this->user_id)->get();
        return $enrolls;
    }

    // regnumber အား auto generate ထုတ်မည်

    // method 1  // custom update မရပေ ( no duplicate )
    // protected static function boot(){ // boot သညိ default method ဖြစ်ပြီး static method ဖြ်စသော ကြာ်င့ protected ဖြင့် ေခါ်ပေးရမည်
    //     parent::boot();

    //     static::creating(function($student){//creating ထဲတွင် လုပ်ဆောင်ချင်သော လုပ်ဆောင်ချက်ကို ရေးပေးရမည်
    //         $lateststudent = \DB::table("students")->orderBy("id","desc")->first();
    //         $lastestid = $lateststudent ? $lateststudent->id : 0; // latest student ရှိသလား ရှီ ရင်ယူမည်မရှိရင် 0 ကို ယူမည်
    //                                         // မူရင်ကို ၁ ပေါင်း , codeအရှည်, ၀ မှ စမည် , ဘယ္်ဘက်မှစမည်
    //         // add column                    str_pad(string,length,pad_string,pad_types);
    //         $student -> regnumber = "WDF".str_pad($lastestid+1,5,"0",STR_PAD_LEFT); // custom update ပေးပါက error တက်နိုင်သည်

    //     });
    // }

    // method 2 ( solved duplicated id)

    protected static function boot(){
        parent::boot();

        static::creating(function($student){
            $student -> regnumber = self::generatestudentid();
        });

    }

    protected static function generatestudentid(){
        return \DB::transaction(function(){
            $lateststudent = \DB::table("students")->orderBy("id","desc")->first();

            $lastestid = $lateststudent ? $lateststudent->id : 0 ;

            $newstudentid = "WDF".str_pad($lastestid+1,5,"0",STR_PAD_LEFT);

            while(\DB::table("students")->where('regnumber',$newstudentid)->exists()){

                $lastestid++; // duplicate ဖြစ်နေပါက 1 ထပ်တိုးမည်ဖြစ်ပြီး အောက်တွင် overwrite လုပ်ပေးမ်ည်ဖြစ်သည်
                $newstudentid = "WDF".str_pad($lastestid+1,5,"0",STR_PAD_LEFT);
            }

            return $newstudentid;
        });
    }

    public function studentphones()
    {
        return $this -> hasMany(StudentPhone::class);
    }

    public function calculateProfileScore(){

        $fields = [
        "firstname",
        "lastname",
        "slug",
        "dob",
        "gender_id",
        "age",
        "email",
        "country_id",
        "city_id",
        "region_id",
        "township_id",
        "address",
        "religion_id",
        "nationalid"
        ];


        $score = 0 ;

        // "regnumber",
        // "image",
        // "firstname",
        // "lastname",
        // "slug",
        // "dob",
        // "gender_id",
        // "age",
        // "email",
        // "country_id",
        // "city_id",
        // "region_id",
        // "township_id",
        // "address",
        // "religion_id",
        // "nationalid",
        // "remark",
        // "status_id",
        // "user_id",
        // "profile_score"

        // profile pricture uploaded or not
        if($this -> hasprofilepicture()){
            $score += 10;
        }

        foreach($fields as $field){
            if(!empty($this->$field)){
                $score += 10;
            }
        }


        // firstname is filled or not 
        // if(!empty($this->firstname)){
        //     $score += 10;
        // }

        // if(!empty($this->lastname)){
        //     $score += 10;
        // }


        // if(!empty($this->dob)){
        //     $score += 10;
        // }


        // if(!empty($this->gender_id)){
        //     $score += 10;
        // }

        // if(!empty($this->age)){
        //     $score += 10;
        // }

        // if(!empty($this->email)){
        //     $score += 10;
        // }

        // if(!empty($this->country_id)){
        //     $score += 10;
        // }

        // if(!empty($this->city_id)){
        //     $score += 10;
        // }

        // if(!empty($this->region_id)){
        //     $score += 10;
        // }

        // if(!empty($this->township_id)){
        //     $score += 10;
        // }

                
        // if(!empty($this->address)){
        //     $score += 10;
        // }
                        
        // if(!empty($this->religion_id)){
        //     $score += 10;
        // }

        // if(!empty($this->nationalid)){
        //     $score += 10;
        // }

        $phonescore = $this -> studentphones()->count();

        if($phonescore > 0) {
            $phonescore = $phonescore * 10 ;
        }

        $score = $this -> convertScoreToPercentage( $score + $phonescore );

        $this -> profile_score = $score;

        $this -> save();

        // 140 + 30 ( phone ) = 170 

        return $score;


    }

    public function hasprofilepicture(){
        return !empty($this->image);
    }

    public function convertScoreToPercentage($score){
        $maxscore = 170;

        $percentage = ($score/$maxscore) * 100;

        return $percentage;
    }

    public function isProfileLock(){
        return $this -> calculateProfileScore() === 100;
    }

}
