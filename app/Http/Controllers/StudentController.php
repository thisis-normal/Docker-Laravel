<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $studentList = Student::query()->get();
        return view('student.index', [
            'studentList' => $studentList
        ]);
    }
    public function create()
    {
        return view('student.create');
    }
    public function store(Request $request)
    {
//        dd($request->post('first_name'));
        $student = new Student();
        $student->first_name = $request->post('first_name');
        $student->last_name = $request->post('last_name');
        $student->gender = $request->post('gender');
        $student->birth_date = date('Y-m-d', strtotime($request->post('birth_date')));
        $student->save();
        return redirect()->route('student.index');
    }
}
