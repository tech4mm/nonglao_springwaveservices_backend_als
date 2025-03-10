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
        Schema::create('company_details', function (Blueprint $table) {
             $table->id();
        $table->text('application_details')->nullable();
        $table->text('company_address')->nullable();
        $table->text('company_bank_details')->nullable();
        $table->string('bank_payment_qr')->nullable(); // Store file path or URL
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};
