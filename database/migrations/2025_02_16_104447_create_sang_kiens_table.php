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
        Schema::create('sang_kien', function (Blueprint $table) {
            $table->id();
            $table->string('ten_sang_kien');
            $table->string('tieu_de');
            $table->string('mo_ta')->nullable();
            $table->unsignedBigInteger('ma_tac_gia');
            $table->foreign('ma_tac_gia')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sang_kien');
    }
};
