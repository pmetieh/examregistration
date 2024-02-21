<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CurlController;
use App\Classes\curl;
use App\User;

class MoodleConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $curl;
    public $user;

    public function __construct (curl $_curl, User $_user){

        $this->curl = $_curl;
        $this->user = $_user;

    }

    public function index()
    {
        //dd($this->curl);
        dd($this->user);
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

    public function createmoodleuser(Request $request)
    {
        //
        $this->getUserDetails();
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

    public function randomPassword() //according to Moodle password requirements
    {
        $part1 = "";
        $part2 = "";
        $part3 = "";

        //alphanumeric LOWER
        $alphabet = "abcdefghijklmnopqrstuwxyz";
        $password_created = array(); //remember to declare $pass as an array
        $alphabetLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 3; $i++)
        {
            $pos = rand(0, $alphabetLength); // rand(int $min , int $max)
            $password_created[] = $alphabet[$pos];
        }
        $part1 = implode($password_created); //turn the array into a string
        //echo"<br/>part1 = $part1";

        //alphanumeric UPPER
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
        $password_created = array(); //remember to declare $pass as an array
        $alphabetLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 3; $i++)
        {
            $pos = rand(0, $alphabetLength); // rand(int $min , int $max)
            $password_created[] = $alphabet[$pos];
        }
        $part2 = implode($password_created); //turn the array into a string
        //echo"<br/>part2 = $part2";

    //alphanumeric NUMBER
        $alphabet = "0123456789";
        $password_created = array(); //remember to declare $pass as an array
        $alphabetLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 2; $i++)
        {
            $pos = rand(0, $alphabetLength); // rand(int $min , int $max)
            $password_created[] = $alphabet[$pos];
        }
        $part3 = implode($password_created); //turn the array into a string
        //echo"<br/>part3 = $part3";

        $password = $part1 . $part2 . $part3 . "#";

        return $password;
    }

    public function getCDate()
    {
        $format = "Ymd";
        $fulldate = date($format);
        //echo"<br/>fulldate = $fulldate";
        return $fulldate;
    }


    public function enrol($user_id, $course_id)
        {
                $role_id = 5; //assign role to be Student

                $domainname = 'ultesting.ul.edu.lr'; //paste your domain here
                $wstoken = 'dd69fff22a7cc8e2a7bd424c805123ec'; //here paste your enrol token
                $wsfunctionname = 'enrol_manual_enrol_users';//enrol_user moodle core web service function name

                $enrolment = array( 'roleid' => $role_id, 'userid' => $user_id, 'courseid' => $course_id );
                $enrolments = array($enrolment);
                $params = array( 'enrolments' => $enrolments );

                header('Content-Type: text/plain');
                $serverurl = $domainname . "/webservice/rest/server.php?wstoken=" . $wstoken . "&wsfunction=" . $wsfunctionname;

                $restformat='';
                //$curl = new curl;
      $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
                $resp = $this->curl->post($serverurl . $restformat, $params);
               // print_r($resp);
    }

    public function enrollGradStudent($chosen_program)
    {
       // $erp = $_erp;
        //dd($erp);

    $firstname  = $this->user->firstName;//"Justina";//"TestUser";
    $lastname   = $this->user->lastName;//"Knuckles";//TestUser";
    $email      = $this->user->email;//"TestUser@zzz.gr";
    $city       = "Monrovia";//"Thessaloniki";
    $country    = "Liberia";//"EL";
    $description= "Prospective student";//"ZZZ";

   // $chosen_program = $this->user->

    //assign username
    //get first two letters of name and surname
    //$strlength_user = strlen($firstname);
    //$strlength_pass = strlen($lastname);
    //$rest_firstname = substr($firstname, 0, 2);
    //$rest_lastname  = substr($lastname, 0, 2);
    //$part1 = $rest_firstname . $rest_lastname;
    //$part1 = strtolower($part1);
    //echo"<br/>part1 = $part1";
    $dt = $this->getCDate();
    $part2 = substr($dt, -4);
    //echo"<br/>part2 = $part2";
    //login name
    $username = $this->user->name;//"jknuckles";//"Pauline Saah";//;$part1 . "." . $part2;
    echo"<br/>Username = $username";

    //assign password
    $password = $this->randomPassword();//"Pa05031969#";
    echo"<br/>Password = $password";

    //call WS core_user_create_user of moodle to store the new user
    $domainname = 'ultesting.ul.edu.lr';
    $wstoken = '1b93c591473c1a484e2909066a4f4344'; //paste your create user token here
    $wsfunctionname = 'core_user_create_users';//create_user moodle core webservice function name
    //REST return value
    $restformat = 'xml';
    //parameters
    $user1 = new \stdClass();
    $user1->username    = $username;
    $user1->password    = $password;
    $user1->firstname   = $firstname;
    $user1->lastname    = $lastname;
    $user1->email       = $email;
    $user1->auth        = 'manual';
    $user1->idnumber    = 'numberID';
    $user1->lang        = 'en';
    $user1->city        = $city;
    $user1->country     = $country;
    $user1->description = $description;

    $users = array($user1);
    $params = array('users' => $users);
    //REST call
   // header('Content-Type: text/plain');
    $serverurl = $domainname . "/webservice/rest/server.php?wstoken=" . $wstoken . "&wsfunction=" . $wsfunctionname;
   // $curl = new curl;
    $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';


   // dd($params);

    $resp = $this->curl->post($serverurl . $restformat, $params);
    dd($resp);
    print_r($resp);

    //get id from $resp
    $xml_tree = new \SimpleXMLElement($resp);
  //  print_r($xml_tree);
    $value = $xml_tree->MULTIPLE->SINGLE->KEY->VALUE;
    $user_id = intval(sprintf("%s",$value));
    echo"<br/>user_id number = $user_id";


    //the graduate course Ids are
    //4 for Maths
    // 5 for English
    // 6 for Science

//check for which program that the student wants to test for and enroll him/her
    //in the appropiate test
    //



    //course_id=2 Graduate School English
    //course_id=3 Graduate School Math

    for($i = 2; $i < 4; $i++)
    {
        $course_id = $i;

        $this->enrol($user_id, $course_id);

    echo "\nThe user has been successfully enrolled to course " .$course_id; //$i;
    }
    return back()->with('userenrol', 'Congratulations!! Registration successful. Check your email for Login credentials');
}

    public function enrollUnderGradStudent()
    {
       // $erp = $_erp;
        //dd($erp);

    $firstname  = $this->user->firstName;//"Justina";//"TestUser";
    $lastname   = $this->user->lastName;//"Knuckles";//TestUser";
    $email      = $this->user->email;//"TestUser@zzz.gr";
    $city       = "Monrovia";//"Thessaloniki";
    $country    = "Liberia";//"EL";
    $description= "Prospective student";//"ZZZ";

   // $chosen_program = $this->user->

    //assign username
    //get first two letters of name and surname
    //$strlength_user = strlen($firstname);
    //$strlength_pass = strlen($lastname);
    //$rest_firstname = substr($firstname, 0, 2);
    //$rest_lastname  = substr($lastname, 0, 2);
    //$part1 = $rest_firstname . $rest_lastname;
    //$part1 = strtolower($part1);
    //echo"<br/>part1 = $part1";
    $dt = $this->getCDate();
    $part2 = substr($dt, -4);
    //echo"<br/>part2 = $part2";
    //login name
    $username = $this->user->name;//"jknuckles";//"Pauline Saah";//;$part1 . "." . $part2;
    echo"<br/>Username = $username";

    //assign password
    $password = $this->randomPassword();// "Pa05031969#";
    echo"<br/>Password = $password";

    //call WS core_user_create_user of moodle to store the new user
    $domainname = 'http://ultesting.ul.edu.lr';
    $wstoken = '1b93c591473c1a484e2909066a4f4344'; //paste your create user token here e8b0ff9c2976d976d8f3cc3d7c156e07
    $wsfunctionname = 'core_user_create_users';//create_user moodle core web service function name
    //REST return value
    $restformat = 'xml';
    //parameters
    $user1 = new \stdClass();
    $user1->username    = $username;
    $user1->password    = $password;
    $user1->firstname   = $firstname;
    $user1->lastname    = $lastname;
    $user1->email       = $email;
    $user1->auth        = 'manual';
    $user1->idnumber    = 'numberID';
    $user1->lang        = 'en';
    $user1->city        = $city;
    $user1->country     = $country;
    $user1->description = $description;

    $users = array($user1);
    $params = array('users' => $users);
    //REST call
   // header('Content-Type: text/plain');
    $serverurl = $domainname . "/webservice/rest/server.php?wstoken=" . $wstoken . "&wsfunction=" . $wsfunctionname;
   // $curl = new curl;
    $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';


   // dd($params);

    $resp = $this->curl->post($serverurl . $restformat, $params);
    //dd($resp);
    print_r($resp);

    //get id from $resp
    $xml_tree = new \SimpleXMLElement($resp);
    print_r($xml_tree);
    $value = $xml_tree->MULTIPLE->SINGLE->KEY->VALUE;
    $user_id = intval(sprintf("%s",$value));
  //  echo"<br/>user_id number = $user_id";

    //enrol_manual_enrol_users
    //for($i = 64; $i < 70; $i++) //where 64,65,66,67,68,69 are the six ids of the six courses of phase 1

//check for which program that the student wants to test for and enroll him/her
    //in the appropiate test


//the undergraduate course Ids are
 //4 for English
// 5 for maths

    for($i = 4; $i < 6; $i++)
    {
        $course_id = $i;

        $this->enrol($user_id, $course_id);

    echo "\nThe user has been successfully enrolled to course " .$course_id; //$i;
    }
    return back()->with('userenrol', 'Congratulations!! Registration successful. Check your email for Login credentials');
}

}
