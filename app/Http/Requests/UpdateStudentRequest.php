<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
////            'id' => 'bail|required|exists:students,id',
            'first_name' => 'bail|required|string|max:255',
            'last_name' => 'bail|required|string|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute field must be a string.',
            'max' => 'The :attribute field must be less than :max characters.',
//            'exists' => 'The :attribute field is not exists.'
        ];
    }
//    public function response(array $errors)
//    {
//        return [
//            '400' => [
//                'message' => 'Invalid data',
//                'errors' => $errors
//            ],
//            '404' => [
//                'message' => 'Student not found'
//            ]
//        ];
//    }
    public function attributes(): array
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name'
        ];
    }
}
