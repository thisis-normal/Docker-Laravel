<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name'
    ];
//    public string $course_name;
//    protected $table = "courses";
    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (new \DateTime($attributes['created_at']))->format('Y-m-d'),
        );
    }
}
