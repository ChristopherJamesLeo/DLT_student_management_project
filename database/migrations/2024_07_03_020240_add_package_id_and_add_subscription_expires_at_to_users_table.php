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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('package_id')->nullable()->after("last_active")->constrained()->onDelete("set null");
            
            // Add the subscription_expires_at timestamp column after package_id
            $table->timestamp('subscription_expires_at')->nullable()->after("package_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropForeign(["package_id"]); // rollback ပြန်ခေါ်တာနှင့် foreign key ပါ ဖြုတ်ခဲ့မည် array ဖြင့် ထည့်ရမည် 
            $table -> dropColumn("package_id");
            $table -> dropColumn("subscription_expires_at");
        });
    }
};
