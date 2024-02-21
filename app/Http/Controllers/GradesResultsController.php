<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
class GradesResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    ///@var $id -- userid
    public function get_all_grades_local($id){

        //$this->get_enrolled_users(2));//$id

        $enrolledusers = $this->get_enrolled_users(2);
       // print_r($enrolledusers);

        for ($i=0; $i < count($enrolledusers); $i++) {
            echo $enrolledusers[$i]->name.'   '.$enrolledusers[$i]->id."<br>";
        }


        echo "<h3>Grades</h3>";

        $curl = curl_init();

        $userid = $id;
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/moodle/webservice/rest/server.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'wstoken=559d43fa8898b377955e95cbf219dfd4&wsfunction=gradereport_overview_get_course_grades&moodlewsrestformat=json&userid='.$userid,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic PEJhc2ljIEF1dGggVXNlcm5hbWU+OjxCYXNpYyBBdXRoIFBhc3N3b3JkPg==',
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp =  json_decode($response, true);

        for ($i=0; $i < count($resp["grades"]); $i++) {
            echo "Courseid : ".$resp["grades"][$i]["courseid"];
            echo "\t\tGrade : ".$resp["grades"][$i]["grade"];
            echo "\t\tUserid : ".$userid;
            echo '<br>';
        }
        //var_dump($resp["grades"][0]["courseid"]); //[1]["rawgrade"]

        //echo "<h1>Enrolled Students</h1><br>";


    }

    public function get_enrolled_users($id)
    {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost/moodle/webservice/rest/server.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'wstoken=3be7787d2ef33d065ad1f52d90694050&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid='.$id.'&=',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $resp = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    $resp = json_decode($resp, true);

    //dd($resp);

    echo "<h1>Course Name  : Mathemathics</h1>";
    echo "<h3>Enrolled Users</h3>";

    //declare an array tohold the student objects
    $students = [];//array();



    for ($i=0; $i < count($resp); $i++) {

        //$student->name = $resp[$i]["fullname"];
        //$student->id = $resp[$i]["id"];


        $students[$i] = new stdClass();

        $students[$i]->name = $resp[$i]["fullname"];
        $students[$i]->id = $resp[$i]["id"];


    //print_r($students[$i]);
     //   echo "<br>";
    }

    //$resp;
    //print_r($students);

     return $students;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    }
