<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sang_kien', function (Blueprint $table) {
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ten_sang_kien VARCHAR(255) AFTER id');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN hien_trang TEXT AFTER ten_sang_kien');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN mo_ta TEXT AFTER hien_trang');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ket_qua TEXT AFTER mo_ta');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ma_tac_gia BIGINT UNSIGNED AFTER ket_qua');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ma_don_vi BIGINT UNSIGNED AFTER ma_tac_gia');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ma_trang_thai_sang_kien BIGINT UNSIGNED AFTER ma_don_vi');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ghi_chu TEXT AFTER ma_trang_thai_sang_kien');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sang_kien', function (Blueprint $table) {
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ten_sang_kien VARCHAR(255) AFTER id');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN hien_trang TEXT AFTER ten_sang_kien');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN mo_ta TEXT AFTER hien_trang');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ket_qua TEXT AFTER mo_ta');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ma_tac_gia BIGINT UNSIGNED AFTER ket_qua');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ma_don_vi BIGINT UNSIGNED AFTER ma_tac_gia');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ma_trang_thai_sang_kien BIGINT UNSIGNED AFTER ma_don_vi');
            DB::statement('ALTER TABLE sang_kien MODIFY COLUMN ghi_chu TEXT AFTER ma_trang_thai_sang_kien');
        });
    }
};
