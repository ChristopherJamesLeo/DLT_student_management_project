<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";
    protected $primaryKey = "id";
    protected $fillable = [
        "image",
        "name",
        "slug",
        "status_id",
        "user_id",
    ];

    public function permissions(){
        // return $this -> belongsToMany(Permission::class,"permission_roles"); 
        // method 1 
        // return $this -> belongsToMany(Permission::class,"permission_roles")->withTimestamps();   // timestamps ကိုသုံးပြီး created_at နှင့် updated_at ကို တစ်ပါတည် ထည့်နိုင်မည် 
        // method 2 
        return $this -> belongsToMany(Permission::class,"permission_roles","role_id","permission_id")->withTimestamps();   // timestamps ကိုသုံးပြီး created_at နှင့် updated_at ကို တစ်ပါတည် ထည့်နိုင်မည် 

    }

    public function user(){
        return $this -> belongsTo(User::class); 
    }

    public function status(){
        return $this -> belongsTo(Status::class); 
    }
}
