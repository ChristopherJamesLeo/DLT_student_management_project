<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table -> string("image")->nullable();
            $table -> unsignedBigInteger("post_id"); 
            $table -> unsignedBigInteger("user_id");
            $table -> enum("stage_id",[1,2,3])->default(2)->comment("0 = Approved, 2 = Pending , 3 = Reject");
            $table -> text("remark")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrolls');
    }
};
