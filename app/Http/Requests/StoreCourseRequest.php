<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
                'unique:courses,course_name',
//                'unique:App\Models\Course,course_name',
                'string',
                'min:3',
                'max:255',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute is required',
            'unique' => ':attribute must be unique',
            'string' => ':attribute must be string',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Course name',
        ];
    }
}
