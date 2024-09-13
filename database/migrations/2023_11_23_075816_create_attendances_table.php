<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); 
            $table->date("classdate"); // မိမိ ထည့်ချင်သော date
            $table->unsignedBigInteger("post_id");
            $table->string("attcode"); 
            $table->unsignedBigInteger("user_id");// attendance ဖြည့်ထဲသူအား login ဝင်ထားသော ကောင်ကိုသာ လွယ်လွယ်ကူကူယူမည် 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
