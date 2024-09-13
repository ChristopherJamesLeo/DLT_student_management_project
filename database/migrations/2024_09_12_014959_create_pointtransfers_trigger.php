<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('pointtransfers_trigger', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        DB::unprepared(
            "
                CREATE TRIGGER pointtransfer_afc
                AFTER INSERT ON points_transfers FOR EACH ROW
                BEGIN
                    INSERT INTO point_transfer_histories (points_transfers_id,user_id,accounttype,points,created_at,updated_at)
                    VALUE(NEW.id,NEW.sender_id,'credit',NEW.points,NOW(),NOW());

                    INSERT INTO point_transfer_histories (points_transfers_id,user_id,accounttype,points,created_at,updated_at)
                    VALUE(NEW.id,NEW.receiver_id,'debit',NEW.points,NOW(),NOW());
                END
            "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('pointtransfers_trigger');

        DB::unprepare(
            "DROP TRIGGER IF EXISTS pointtransfer_afc"
        );
    }
};
