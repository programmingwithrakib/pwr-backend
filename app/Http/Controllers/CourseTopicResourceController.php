<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\CourseTopicDataStoreRequest;
use App\Http\Requests\CourseTopicDataUpdateRequest;
use App\Http\Requests\CourseTopicResourceStoreRequest;
use App\Http\Requests\CourseTopicResourceUpdateRequest;
use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\CourseTopicData;
use App\Models\CourseTopicResource;
use Illuminate\Http\Request;

class CourseTopicResourceController extends Controller
{
    public function index(Request $request){
        $courses = Course::all();
        $query = CourseTopicResource::query();
        if($course_id = $request->get('course-id')){
            $query->where('course_id', $course_id);
        }
        if($course_topic_id = $request->get('course-topic-id')){
            $query->where('course_topic_id', $course_topic_id);
        }
        $resources = $query->paginate(10)->withQueryString();
        return view('course-topic-resource.index', compact('resources', 'courses'));
    }

    public function show($id){
        $course_topic_resource =  CourseTopicResource::findOrFail($id);
        return view('course-topic-resource.show', compact('course_topic_resource'));
    }

    public function create(Request $request)
    {
        $courses = Course::all();
        return view('course-topic-resource.create', compact(  'courses'));
    }

    public function edit($id, Request $request)
    {
        $courses = Course::all();
        $course_topic_resource =  CourseTopicResource::findOrFail($id);
        $course_topics = CourseTopic::where('course_id', $course_topic_resource->course_id)->get();

        return view('course-topic-resource.edit', compact('course_topic_resource', 'courses', 'course_topics'));
    }


    public function store(CourseTopicResourceStoreRequest $request){

        $data = $request->validated();

        try {
            CourseTopicResource::create($data);
            return redirect()->route('course_topic_resource.index')->with('success', "Created Successfully");
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, CourseTopicResourceUpdateRequest $request){
        $course_topic_resource = CourseTopicResource::findOrFail($id);
        $data = $request->validated();


        try {
            $course_topic_resource->update($data);
            return $this->successMessage("Updated Successfully");
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }


    public function delete($id){
        $course_topic_resource =  CourseTopicResource::findOrFail($id);
        $course_topic_resource->delete();
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
