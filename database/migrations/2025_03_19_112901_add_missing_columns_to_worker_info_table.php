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
        Schema::table('worker_infos', function (Blueprint $table) {
            //
            $table->string('thai_phone_no')->nullable();
            $table->string('myan_phone_no')->nullable();
            $table->text('thai_address')->nullable();
            $table->text('myan_address')->nullable();
            $table->text('work_place_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('worker_infos', function (Blueprint $table) {
            //
            $table->dropColumn([
                'thai_phone_no',
                'myan_phone_no',
                'thai_address',
                'myan_address',
                'work_place_address'
            ]);
        });
    }
};
