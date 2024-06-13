<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pageview extends Model
{
    use HasFactory;
    protected $table = "pageviews";
    protected $primaryKey = "id";
    protected $fillable = [
        "pageurl",
        "counter"
    ];


}

// middle ware ကို  live ဖြစ်နေရန်သံုးသည် 
// App\Http\Middleware 
// Karnel သည် middleware လံုးကို ေပါင်းထားသောကြောင့် ၄င်းနှစ်ဖိုင်အား ပေါင်းအလုပ်လုပ်ပေးရမည်
// php artisan make:middleware PageView