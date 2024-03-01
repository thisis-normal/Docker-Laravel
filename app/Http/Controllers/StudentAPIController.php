<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentApiRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class StudentAPIController extends Controller
{
    public function index(): JsonResponse
    {
        $studentList = Student::query()->get();
        return response()->json($studentList);
    }

    public function show($id): JsonResponse
    {
        $student = Student::query()->find($id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
        return response()->json($student);
    }

    public function store(FormRequest $request): JsonResponse
    {
        var_dump(1);
        die();
        $student = new Student();
        $student->first_name = request()->post('first_name');
        $student->last_name = request()->post('last_name');
        $student->gender = $request->post('gender');
        $student->birth_date = date('Y-m-d', strtotime($request->post('birth_date')));
        $student->save();
        return response()->json($student);
    }

    public function update(UpdateStudentApiRequest $request): JsonResponse
    {
        dd($request->all(), $request->validated());
        var_dump($student);
        die();
        $student->save();
        return response()->json(1);
    }
//    {
//        $student = Student::query()->find($id);
//        if (!$student) {
//            return response()->json([
//                'message' => 'Student not found'
//            ], 404);
//        }
//        $student->first_name = request()->post('first_name');
//        $student->last_name = request()->post('last_name');
//        //update the student infor
//        $student->save();
//        return response()->json($student);
//    }
    public function destroy($id)
    {
        $student = Student::query()->find($id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
        $student->delete();
        return response()->json([
            'message' => 'Student deleted'
        ]);
    }

    public function viewImage()
    {
        //return image path in storage/app/public folder
        return response()->json([
            'image_path' => 'storage/app/public/background.png'
        ]);
    }
    public function renderImage()
    {
        //return image file
//        return response()->json([
//            'img' => file_get_contents(storage_path('app/public/background.png'))
//        ]);
        return response()->file(storage_path('app/public/background.png'));
    }
}
