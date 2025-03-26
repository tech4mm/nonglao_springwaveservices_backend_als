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
        Schema::create('dependency_relatives', function (Blueprint $table) {
            $table->id();
            $table->string('e_title');
        $table->text('e_body');
        $table->string('m_title');
        $table->text('m_body');
        $table->string('t_title');
        $table->text('t_body');
        $table->string('s_title');
        $table->text('s_body');
        $table->boolean('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependency_relatives');
    }
};
