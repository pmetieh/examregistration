<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestingCenter extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['centerName', 'capacity', 'noAssigned',  'filled', 'tcLocation'];

//the relationship between testingcenter and user is one to many
//a testing center can have many users assigned to it.    
 public function user() 
 {
 	return $this->hasMany(User::class);
 }

}
