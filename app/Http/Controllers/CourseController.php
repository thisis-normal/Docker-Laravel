<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Application|Factory|View
    {
        $search = $request->get('search') ?? '';
        $data = Course::query()
            ->where('course_name', 'like', "%$search%")
            ->paginate(2);
        $data->appends(['search' => $search]);
        return view('course.index', [
            'courseList' => $data,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
//        $course = new Course();
//        $course->fill($request->validated());
//        if ($course->save()) {
//            return redirect()->route('course.index');
//        }
        Course::query()->create($request->validated());
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('course.edit', [
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
//        Course::query()
//            ->where('id', $course->id)
//            ->update($request-
//        $course->update($request->except('_token', '_method'));
        $course->fill($request->validated());
        $course->save();
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        //other way to delete
        //Course::destroy($course->id);
        return redirect()->route('course.index');
    }
}
