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
        "firstname",
        "lastname",
        "slug",
        "remark",
        "status_id",
        "user_id"

    ];

    public function user(){
        return $this -> belongsTo("App\Models\User"); // send all columns from statuses table
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

}
