<?php

namespace Modules\Course\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\CourseCategory;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Course::all();

        return view('course::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = CourseCategory::all();

        return view('course::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses'
        ]);
        try {
            $course = Course::create([
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'duration' => $request->duration,
                'course_count' => $request->course_count,
                'student_count' => $request->student_count,
                'language' => $request->language,
                'level' => $request->level,
                'image_alt' => $request->image_alt,
                'image' => (isset($request->image)?file_store($request->image, 'assets/uploads/photos/course_images/','photo_'):null),
                'banner' => (isset($request->banner)?file_store($request->banner, 'assets/uploads/photos/course_banners/','photo_'):null)
            ]);

            return redirect()->route('course.index')->with('flash_message', 'با موفقیت ثبت شد');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('course::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Course $course)
    {
        $categories = CourseCategory::all();

        return view('course::edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Course $course)
    {
        try {
            $course->category_id = $request->category_id;
            $course->title = $request->title;
            $course->slug = $request->slug;
            $course->description = $request->description;
            $course->duration = $request->duration;
            $course->course_count = $request->course_count;
            $course->student_count = $request->student_count;
            $course->language = $request->language;
            $course->level = $request->level;
            $course->image_alt = $request->image_alt;
            if (isset($request->image)) {
                if ($course->image){
                    File::delete($course->image);
                }
                $course->image = file_store($request->image, 'assets/uploads/photos/course_images/','photo_');
            }
            if (isset($request->banner)) {
                if ($course->banner){
                    File::delete($course->banner);
                }
                $course->banner = file_store($request->banner, 'assets/uploads/photos/course_banners/','photo_');
            }

            $course->save();

            return redirect()->route('course.index')->with('flash_message', 'با موفقیت بروزرسانی شد');
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();

            return redirect()->back()->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
