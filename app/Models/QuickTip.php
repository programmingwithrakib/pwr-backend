<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickTip extends Model
{
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
