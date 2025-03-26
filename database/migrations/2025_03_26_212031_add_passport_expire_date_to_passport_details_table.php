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
        Schema::table('passport_details', function (Blueprint $table) {
             $table->date('passport_expire_date')->nullable()->after('passport_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('passport_details', function (Blueprint $table) {
            //
            $table->dropColumn('passport_expire_date');
        });
    }
};
