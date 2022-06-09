<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Grad extends Model
{
    //
    protected $fillable = ['user_id','uniLoc','gpa', 'medicalSchool', 'degreeEarned', 'numAttempts'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
