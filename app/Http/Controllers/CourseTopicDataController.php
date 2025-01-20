<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\CourseTopicDataStoreRequest;
use App\Http\Requests\CourseTopicDataUpdateRequest;
use App\Http\Requests\CourseTopicStoreRequest;
use App\Http\Requests\CourseTopicUpdateRequest;
use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\CourseTopicData;
use Illuminate\Http\Request;

class CourseTopicDataController extends Controller
{
    public function index(Request $request){
        $courses = Course::all();
        $query = CourseTopicData::query();
        if($course_id = $request->get('course-id')){
            $query->where('course_id', $course_id);
        }
        if($course_topic_id = $request->get('course-topic-id')){
            $query->where('course_topic_id', $course_topic_id);
        }
        $course_topic_data = $query->paginate(10)->withQueryString();
        return view('course-topic-data.index', compact('course_topic_data', 'courses'));
    }

    public function show($id){
        $course_topic_data =  CourseTopicData::findOrFail($id);
        return view('course-topic-data.show', compact('course_topic_data'));
    }

    public function create(Request $request)
    {
        $courses = Course::all();
        $course = Course::get();
        return view('course-topic-data.create', compact(  'course', 'courses'));
    }

    public function edit($id, Request $request)
    {
        $courses = Course::all();
        $course_topic_data =  CourseTopicData::findOrFail($id);
        $course_topics = CourseTopic::where('course_id', $course_topic_data->course_id)->get();

        return view('course-topic-data.edit', compact('course_topic_data', 'courses', 'course_topics'));
    }


    public function store(CourseTopicDataStoreRequest $request){

        $data = $request->validated();

        try {
            CourseTopicData::create($data);
            return redirect()->route('course_topic_data.index')->with('success', "Created Successfully");
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, CourseTopicDataUpdateRequest $request){
        $course_topic_data = CourseTopicData::findOrFail($id);
        $data = $request->validated();


        try {
            $course_topic_data->update($data);
            return $this->successMessage("Updated Successfully");
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }


    public function delete($id){
        $course_topic_data =  CourseTopicData::findOrFail($id);
        $course_topic_data->delete();
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
