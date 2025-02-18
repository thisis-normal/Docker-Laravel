<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SangKien extends Model
{
    use HasFactory;
    protected $table = 'sang_kien';
    protected $fillable = [
        'id',
        'ten_sang_kien',
        'hien_trang',
        'mo_ta',
        'ket_qua',
        'ma_tac_gia',
        'ma_don_vi',
        'ma_trang_thai_sang_kien',
        'ghi_chu',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'files' => 'array',
    ];
    //define relationship with User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ma_tac_gia', 'id');
    }
    public function taiLieuSangKien(): HasMany
    {
        return $this->hasMany(TaiLieuSangKien::class, 'sang_kien_id');
    }
}
