<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Otp extends Model
{
    use HasFactory;
    use Notifiable; 

    protected $table = "otps";
    protected $primaryKey = "id";
    protected $fillable = [
        "user_id",
        "otp",
        "expires_at",
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
}
