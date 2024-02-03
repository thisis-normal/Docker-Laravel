<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_name' => [
                'bail',
                'required',
                'string',
                'max:255',
//                Rule::unique(Course::class)->ignore($this->route('course')),
                Rule::unique(Course::class)->ignore($this->course->id),
            ]
        ];
    }
    public function messages (): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute field must be a string.',
            'max' => 'The :attribute field must be less than :max characters.',
            'unique' => 'The :attribute field is already exists.',
        ];
    }
    public function attributes(): array
    {
        return [
            'course_name' => 'Course Name',
        ];
    }
}
