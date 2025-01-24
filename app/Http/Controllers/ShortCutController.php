<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseTopicDataStoreRequest;
use App\Http\Requests\CourseTopicDataUpdateRequest;
use App\Http\Requests\TopicShortCutStoreRequest;
use App\Http\Requests\TopicShortCutUpdateRequest;
use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\CourseTopicData;
use App\Models\TopicShortCut;
use Illuminate\Http\Request;

class ShortCutController extends Controller
{
    public function index(Request $request){
        $courses = Course::all();
        $query = TopicShortCut::query();
        if($course_id = $request->get('course-id')){
            $query->where('course_id', $course_id);
        }
        if($course_topic_id = $request->get('course-topic-id')){
            $query->where('course_topic_id', $course_topic_id);
        }
        $short_cuts = $query->paginate(10)->withQueryString();
        return view('short-cuts.index', compact('short_cuts', 'courses'));
    }

    public function show($id){
        $course_topic_data =  CourseTopicData::findOrFail($id);
        return view('short-cuts.show', compact('course_topic_data'));
    }

    public function create(Request $request)
    {
        $courses = Course::all();
        $course = Course::get();
        return view('short-cuts.create', compact(  'course', 'courses'));
    }

    public function edit($id, Request $request)
    {
        $courses = Course::all();
        $short_cut =  TopicShortCut::findOrFail($id);
        $course_topics = CourseTopic::where('course_id', $short_cut->course_id)->get();

        return view('short-cuts.edit', compact('short_cut', 'courses', 'course_topics'));
    }


    public function store(TopicShortCutStoreRequest $request){

        $data = $request->validated();

        try {
            TopicShortCut::create($data);
            return redirect()->route('short_cuts.index')->with('success', "Created Successfully");
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, TopicShortCutUpdateRequest $request){
        $short_cut = TopicShortCut::findOrFail($id);
        $data = $request->validated();


        try {
            $short_cut->update($data);
            return $this->successMessage("Updated Successfully");
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }


    public function delete($id){
        $short_cut =  TopicShortCut::findOrFail($id);
        $short_cut->delete();
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
