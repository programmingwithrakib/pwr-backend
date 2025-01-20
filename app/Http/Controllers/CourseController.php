<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Helper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    public function index(Request $request){
        $courses = Course::paginate(10)->withQueryString();
        return view('course.index', compact('courses'));
    }

    public function show($id){
        $course =  Course::findOrFail($id);
        return view('course.show', compact('course'));
    }
    public function getCourseWiseTopic($id){
        $course =  Course::findOrFail($id);
        return $course->topics()->select('id', 'name')->get();
    }

    public function create(Request $request)
    {
        $course = Course::get();
        return view('course.create', compact(  'course'));
    }

    public function edit($id, Request $request)
    {
        $course = Course::findOrFail($id);
        if (!$course){
            abort(404, 'not fond');
        }

        return view('course.edit', compact('course'));
    }


    public function store(CourseStoreRequest $request){
        $data = collect($request->validated())
            ->merge(['image' => Helper::FileUpload(request_key: 'image', path: 'files')])
            ->toArray();

        try {
            Course::create($data);
            DB::commit();
            return redirect()->route('course.index')->with('success', "Created Successfully");
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, CourseUpdateRequest $request){
        $course = Course::findOrFail($id);
        $data = collect($request->validated());

        if($path = Helper::FileUpload(request_key: 'image', path: 'files')){
            $data = $data->merge(['image' => $path]);
            Helper::RemoveFile($course->image);
        }

        try {
            $course->update($data->toArray());
            return $this->successMessage("Updated Successfully");
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }


    public function delete($id){
        $course =  Course::findOrFail($id);
        $course->delete();
        Helper::RemoveFile($course->imgX);
        return $this->successMessage("Deleted Successfully");
    }



    public function changeStatus($id){
        $invoice =  User::find($id);
        if (!$invoice){
            abort(404);
        }

        $invoice->is_close = !$invoice->is_close;
        $invoice->save();
        return $this->successMessage('Updated Successfully');
    }
}
