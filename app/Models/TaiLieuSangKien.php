<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaiLieuSangKien extends Model
{
    use HasFactory;
    protected $table = 'tai_lieu_sang_kien';
    protected $fillable = ['sang_kien_id', 'file_path'];

    public function sangKien(): BelongsTo
    {
        return $this->belongsTo(SangKien::class);
    }
}
