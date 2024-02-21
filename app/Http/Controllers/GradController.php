<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Grad;
use App\Payment;
use App\Classes\curl;
use App\Http\Controllers\SMSController;
use App\Events\ExamRegistration;
use Mailgun\Mailgun;

class GradController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $chosen_program;

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
        return view('pages.inputdata_grad', ['formtype'=>'grad']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allinput = $request->all();
        $output = array();

        $phoneNo = $request->input('mobileNo');
        $fName = $request->input('firstName');
        $lName = $request->input('lastName');

       // dd($request);
    //   $validate = $request->validate([
     //       'name' => 'required|unique:posts|max:255',
       //     'firstName' => 'required',
       // ]);
        //dd( $validate);
        $request->validate([
            'name' => 'required|email',
            'email' => 'required|email',
            'password' => 'required',
            'firstName' => 'string|required',
            'otherName' => 'string|required',
            'lastName' => 'string|required',
            'dob' => 'string|required',
            'gender' => 'required',
            'mobileNo' => 'required|integer',
            'cellNumber1' => 'required|integer',
            'cellNumber2' => 'required|integer',
            'maritalStatus' => 'required',
            'countyOfO' => 'required',
            'nationality' => 'required',
            'examNo' => 'required|integer',
            'uniLoc' => 'required',
            'gpa' => 'required',
            'degreeEarned' => 'required',
            'medicalSchool'=> 'required',
            'numAttempts' => 'required',
            'amntpaid' => 'required| numeric',
            'paydate' => 'required',
            'bankRecptNo' => 'required|integer'


        ]);

        $user = User::create(
                   [

                    'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'password'=>bcrypt($request->input('password')),
                    'firstName'=>$request->input('firstName'),
                    'otherName'=>$request->input('otherName'),
                    'lastName'=>$request->input('lastName'),
                    'dob'=>$request->input('dob'),
                    'gender'=>$request->input('gender'),
                    'mobileNo'=>$request->input('mobileNo'),
                    'emergencyNo1'=>$request->input('cellNumber1'),
                    'emergencyNo2'=>$request->input('cellNumber2'),
                    'maritalStatus'=>$request->input('maritalStatus'),
                    'countyOfO'=>$request->input('countyOfO'),
                    'nationality'=>$request->input('nationality')
                ]);


        $gradData = Grad::create(
                   [
                    'user_id'=>$user->id,
                    'examNo'=>$request->input('examNo'),
                    'uniLoc'=>$request->input('uniLoc'),
                    'gpa'=>$request->input('gpa'),
                    'degreeEarned'=>$request->input('degreeEarned'),
                    'medicalSchool'=>$request->input('medicalSchool'),
                    'numAttempts'=>$request->input('numAttempts')
                   ]
                );

         $payment = Payment::create(
            [
            'user_id'=>$user->id,
            'amntpaid'=>$request->input('amntpaid'),
            'paydate'=>$request->input('paydate'),
            'bankRecptNo'=>$request->input('bankRecptNo')
        ]);

         $this->chosen_program = $request->input('medicalSchool');

         //assign the student role with id 3 to the user
                $user->roles()->attach(3);

          $mc = new MoodleConnectionController(new curl(), $user);

        //dd($mc);

        //create and enrol the student
      //  $erp = App::make(ExamRegistrationService::class);
       // dd($erp);
        //initialize the user property of the ExamRegistration Service Object
      //  $erp->user = $user;

        $mc->enrollGradStudent($this->chosen_program);

        //send email to student
     $this->sendMailApi($user);
        //redirect
       // return redirect("");
       // return redirect('https://ulentrance.harrisviskinda.com/')
         //   ->with('success'.'Welcome to ULEntrance Exam WebSite');
       // event(new ExamRegistration($user));
//suppress the output of the function sendSMSMessage()
          ob_start();
        $smsctrl = new SMSController($phoneNo,$fName,$lName);
       // $smsctrl->sendSMSMessage();
        $smsctrl->sendSMSBiodataRegTwilio();
         ob_end_clean();

        return back()->with('success','Application successful!');
    }

    public function sendMailApi(User $user = null)
    {


        # Instantiate the client.
        $mgClient =
         Mailgun::create('4499cdbe871e787a631542955b9bad39-9b1bf5d3-98082911', 'https://api.mailgun.net/v3/examregistration.ul.edu.lr');
        $domain = "examregistration.ul.edu.lr";
        $params = array(
          'from'    => 'ULExamRegistration <postmaster@examregistration.ul.edu.lr>',
          'to'      => $user->email,//'metiehpc@ul.edu.lr'
          'subject' => 'UL ExamRegistration',
          'text'    => 'Congratulations! You have successfully registered for the UL Entrance Exam!  UL Entrance Exam! http://ulentrance.ul.edu.lr'
        );

        # Make the call to the client.
        $mgClient->messages()->send($domain, $params);

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
    public function regGrads()
    {

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

    public function exceldata()
    {
        //
        return 'Generating Excel Data';

    }
}
