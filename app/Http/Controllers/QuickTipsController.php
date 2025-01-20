<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\CourseTopicStoreRequest;
use App\Http\Requests\CourseTopicUpdateRequest;
use App\Http\Requests\QuickTipsSoreRequest;
use App\Http\Requests\QuickTipsUpdateRequest;
use App\Models\Course;
use App\Models\CourseTopic;
use App\Models\QuickTip;
use Illuminate\Http\Request;

class QuickTipsController extends Controller
{
    public function index(Request $request){
        $courses = Course::all();
        $query = QuickTip::query();
        if($course_id = $request->get('course-id')){
            $query->where('course_id', $course_id);
        }
        $quick_tips = $query->paginate(10)->withQueryString();
        return view('quick-tips.index', compact('quick_tips', 'courses'));
    }

    public function show($id){
        $quick_tip =  QuickTip::findOrFail($id);
        return view('quick-tips.show', compact('quick_tip'));
    }

    public function create(Request $request)
    {
        $courses = Course::get();
        return view('quick-tips.create', compact(  'courses'));
    }

    public function edit($id, Request $request)
    {
        $courses = Course::all();
        $quick_tip = QuickTip::findOrFail($id);

        return view('quick-tips.edit', compact('quick_tip', 'courses'));
    }


    public function store(QuickTipsSoreRequest $request){

        $data = collect($request->validated())
            ->toArray();

        try {
            QuickTip::create($data);
            return redirect()->route('quick_tips.index')->with('success', "Created Successfully");
        }
        catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }
    }


    public function update($id, QuickTipsUpdateRequest $request){
        $quick_tip = QuickTip::findOrFail($id);
        $data = collect($request->validated());

        try {
            $quick_tip->update($data->toArray());

            return $this->successMessage("Updated Successfully");
        }
        catch (\Exception $exception){
            return $this->errorMessage($exception->getMessage());
        }
    }


    public function delete($id){
        $quick_tip =  QuickTip::findOrFail($id);
        $quick_tip->delete();
        Helper::RemoveFile($quick_tip->imgX);
        return $this->successMessage("Deleted Successfully");
    }



    public function changeStatus($id){
        $quick_tip =  QuickTip::find($id);
        if (!$quick_tip){
            abort(404);
        }

        $quick_tip->status = !$quick_tip->status;
        $quick_tip->save();
        return $this->successMessage('Updated Successfully');
    }
}
