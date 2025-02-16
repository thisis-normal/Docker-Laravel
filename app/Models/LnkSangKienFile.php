<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LnkSangKienFile extends Model
{
    use HasFactory;
    protected $table = 'lnk_sang_kien_files';
    protected $fillable = ['sang_kien_id', 'file_path'];

    public function sangKien(): BelongsTo
    {
        return $this->belongsTo(SangKien::class);
    }
}
