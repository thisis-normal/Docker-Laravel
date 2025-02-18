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
    protected $fillable = ['ten_sang_kien', 'mo_ta', 'ma_tac_gia', 'files'];
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
