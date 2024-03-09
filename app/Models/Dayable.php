<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dayable extends Model
{
    use HasFactory;

    protected $table = "dayables";

    public $timestamps = false; // time stamp မထည့်အောင် ပြောပေးခြင်းဖြစ်သည် // public ဖြင့် ဘဲ ပေးရမည် 

    protected $fillbale = [
        "day_id",
        "dayable_id",
        "dayable_type"
    ];

    
}

