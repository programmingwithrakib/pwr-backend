<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $guarded = [];

    function topics()
    {
        return $this->hasMany(CourseTopic::class);
    }
}
