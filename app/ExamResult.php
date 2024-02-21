<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    //
    protected $fillable = ['user_id','moodle_id', 'course_name', 'raw_grade'];
}
