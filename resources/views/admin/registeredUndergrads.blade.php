@extends('layouts.adminmaster', ['pageTitle'=>'Registered Undergraduates']);
<?php
/**
 * Created by PhpStorm.
 * User: Dell-PC
 * Date: 11/13/2017
 * Time: 2:49 PM
 */
use App\User;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\DB;
use App\TestingCenter;
use App\UnderGrad;
use App\College;
use App\School;
use App\Major;


//get all undergraduates
$ugradIds = array();
$ugrads = UnderGrad::all();
            $ugradIds = array();
            $i = 0;

            foreach ($ugrads as $ug) {
                $ugradIds[$i++] = $ug->user_id; 
            }

?>

@section('content')
    <div id="main" class="row">



        <?php

      //  $users = User::all();
        //dd($users);
        echo '<p><h2>Registered Undergraduate Examinees</h2></p>';
        echo '<table class="table table-responsive">'.
                '<tr>'.
                '<th>ExamNo</th>'.
                '<th>Email</th>'.
                '<th>FirstName</th>'.
                '<th>OtherName</th>'.
                '<th>SurName</th>'.
                '<th>Gender</th>'.
                '<th>MobileNo1</th>'.
                '<th>College</th>'.
                '<th>High School</th>'.
                '<th>Major</th>'.
                '<th>Test Center</th>'.
                /*'<th>PlaceOfBirth</th>'.
                '<th>DateOfBirth</th>'
                '<th>City</th>'.
                '<th>Street1</th>'.
                '<th>Street2</th>'.
                '<th>HouseNo</th>'.
                '<th>Country</th>'.
                '<th>SocialMediaId</th>'*/
                '</tr>';

        for($i = 0; $i < count($ugradIds); $i++)
        {

            //get the exam center
             $testing_center_Id = DB::table('assigntc')->where('user_id', $ugradIds[$i])->get();
             //dd($testing_center_Id->toArray()['testing_center_id']);
             foreach ($testing_center_Id as $tc) {
                 # code...
                $tcId = $tc->testing_center_id;
             }
              

            $user = User::findOrFail($ugradIds[$i]);
           // dd($user->undergrad->collegeChoice);
            echo  '<tr>'.
                    '<td>'.$user->undergrad->examNo.'</td>'.
                    '<td>'.$user->email.'</td>'.
                    '<td>'.$user->firstName.'</td>'.
                    '<td>'.$user->otherName.'</td>'.
                    '<td>'.$user->lastName.'</td>'.
                    '<td>'.$user->gender.'</td>'.
                    '<td>'.$user->mobileNo1.'</td>'.
                    '<td>'.College::find($user->undergrad->collegeChoice)->collegeName.'</td>'.
                    '<td>'.School::find($user->undergrad->highSchool)->schName.'</td>'.
                    '<td>'.Major::find($user->undergrad->majorName)->majorName.'</td>'.
                    '<td>'.TestingCenter::find($tcId)->centerName.'</td>'.
                    '</tr>';
        }

        echo  '</table>';


        ?>



    </div>
    <br />
@endsection