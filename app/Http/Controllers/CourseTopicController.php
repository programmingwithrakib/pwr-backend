<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseTopicStoreRequest;
use App\Http\Requests\CourseTopicUpdateRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;
use App\Models\CourseTopic;
use Illuminate\Http\Request;

class CourseTopicController extends Controller
{
    public function index(Request $request){
        $courses = Course::all();
        $query = CourseTopic::query();
        if($course_id = $request->get('course-id')){
            $query->where('course_id', $course_id);
        }
        $course_topics = $query->paginate(10)->withQueryString();
        return view('course-topic.index', compact('course_topics', 'courses'));
    }

    public function show($id){
        $course_topic =  CourseTopic::findOrFail($id);
        return view('course-topic.show', compact('course_topic'));
    }

    public function create(Request $request)
    {
        $courses = Course::all();
        $course = Course::get();
        return view('course-topic.create', compact(  'course', 'courses'));
    }

    public function edit($id, Request $request)
    {
        $courses = Course::all();
        $course_topic = CourseTopic::findOrFail($id);

        return view('course-topic.edit', compact('course_topic', 'courses'));
    }


    public function store(CourseTopicStoreRequest $request){

        $data = collect($request->validated())
            ->merge(['image' => Helper::FileUpload(request_key: 'image', path: 'files')])
            ->toArray();

        try {
            CourseTopic::create($data);
            return redirect()->route('course_topic.index')->with('success', "Created Successfully");
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, CourseTopicUpdateRequest $request){
        $course_topic = CourseTopic::findOrFail($id);
        $data = collect($request->validated());


        if($path = Helper::FileUpload(request_key: 'image', path: 'files')){
            $data = $data->merge(['image' => $path]);
            Helper::RemoveFile($course_topic->image);
        }

        try {
            $course_topic->update($data->toArray());
            return $this->successMessage("Updated Successfully");
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }


    public function delete($id){
        $course_topic =  CourseTopic::findOrFail($id);
        $course_topic->delete();
        Helper::RemoveFile($course_topic->imgX);
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
