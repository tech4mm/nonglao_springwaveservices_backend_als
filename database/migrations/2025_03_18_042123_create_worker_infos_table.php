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
        Schema::create('worker_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('passport_no')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('company_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('thai_phone_no')->nullable();
            $table->string('myan_phone_no')->nullable();
            $table->text('thai_address')->nullable();
            $table->text('myan_address')->nullable();
            $table->text('work_place_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_infos');
    }
};
