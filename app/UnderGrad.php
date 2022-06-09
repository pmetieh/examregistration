<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UnderGrad extends Model
{
    //
    protected $fillable = [

    						'user_id','schCategory',
    						'eduLevel','highSchool',
    						'graduationYear','locCounty',
    						'locDistrict', 'collegeChoice',
    						'majorName','examNo', 'numAttempts'
    					];


    public function user()
    {
    	return $this->belongsTo(User::class);
    } 
    					
}
