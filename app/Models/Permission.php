<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "slug",
        "status_id",
        "user_id",
    ];

    public function roles(){
        return $this -> belongsToMany(Role::class,"permission_roles"); 
    }

    public function user(){
        return $this -> belongsTo(User::class); 
    }

    public function status(){
        return $this -> belongsTo(Status::class); 
    }
}


// php artisan make:model Permission -m 
// php artisan make:model RoleUser - m 
// php artisan migrate 