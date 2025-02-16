<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder|Feedback newModelQuery()
 * @method static Builder|Feedback newQuery()
 * @method static Builder|Feedback query()
 * @method static Model|Feedback create(array $attributes = [])
 */
class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'email', 'file_path'];

}
