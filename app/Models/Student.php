<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use voku\helper\ASCII;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";
    private string $first_name;
    private string $last_name;
    private bool $gender;
    private datetime $birth_date;


    /**
     * Get the user's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name'],
        );
    }

    public function age(): Attribute
    {
        return Attribute::make(
//            get: function($value, $attributes) {
//                $birthDate = new DateTime($attributes['birth_date']);
//                $now = new DateTime();
//                $interval = $now->diff($birthDate);
//                return $interval->y;
//        });
            get: fn($value, $attributes) => (new DateTime($attributes['birth_date']))->diff(new DateTime())->y,
        );
    }
    //render gender from boolean to string
    public function gender() : Attribute
    {
        return Attribute::make(
//            get: fn($value, $attributes) => $attributes === '1' ? 'Male' : 'Female',
            get: function ($value, $attributes) {
                return $attributes['gender'] === 1 ? 'Male' : 'Female';
            }
        );
    }
}
