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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table -> string("firstname");
            $table -> string("lastname")->nullable();
            $table -> date("birthday")->nullable();
            $table -> unsignedBigInteger("relative_id")->nullable();
            $table -> foreignId("user_id")->constrained(
                // user tble နျ်င့် foreign key ပေးထားကြောင်း ပြောနေခြင်းြဖစသ်သည် မပေးလဲရသည် 
                table:"users",
                indexName:"contacts_users_id"
            )->onUpdate("cascade")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
