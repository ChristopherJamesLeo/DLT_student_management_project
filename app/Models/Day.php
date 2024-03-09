<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    
    protected $table = "days";
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "slug",
        "user_id",
        "status_id",
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    } 
    
    public function status(){
        return $this -> belongsTo(Status::class);
    }

    public function posts(){
        return $this -> morphedByMany(Post::class,"dayable");
    }
}
