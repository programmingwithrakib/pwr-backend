<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTopicData extends Model
{
    protected $guarded = [];


    function course()
    {
        return $this->belongsTo(Course::class);
    }
    function course_topic()
    {
        return $this->belongsTo(CourseTopic::class);
    }
}
