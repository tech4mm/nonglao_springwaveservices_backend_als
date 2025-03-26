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
            //
             $table->string('user_picture')->nullable();
        });
        Schema::table('worker_infos', function (Blueprint $table) {
            $table->string('other_name')->nullable()->after('user_id');
            $table->string('gender')->nullable()->after('other_name');
            $table->date('date_of_birth')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });

        Schema::table('worker_infos', function (Blueprint $table) {
            $table->dropColumn(['other_name', 'gender', 'date_of_birth']);
        });
    }
};
