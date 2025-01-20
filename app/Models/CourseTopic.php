<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTopic extends Model
{
    protected $guarded = [];
    function topic_data()
    {
        return $this->hasMany(CourseTopicData::class);
    }

    function resources()
    {
        return $this->hasMany(CourseTopicResource::class);
    }

    function course()
    {
        return $this->belongsTo(Course::class);
    }
}
