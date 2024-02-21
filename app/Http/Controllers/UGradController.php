<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\UnderGrad;
use App\User;
use App\Payment;
use App\School;
use App\County;
use App\College;
use App\Major;
use Excel;
use Mail;
use Auth;
use App\Mail\ExamNotification;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Controllers\MoodleConnectionController;
use App\Classes\curl;
use Illuminate\Support\Facades\App;
use App\Classes\ExamRegistrationService;
use App\Http\Controllers\SMSController;
use Mailgun\Mailgun;
use App\Events\ExamRegistration;
use Validator;

//use App\User;
/*use App\Classes\PHPExcel\IOFactory;
use vendor\phpoffice\phpexcel\Classes\PHPExcel\PHPExcel;*/
 /**/
class UGradController extends Controller
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
        return view('pages.inputdata');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //         dd($request);

        $validate = $request->validate([
            'name' => 'required'
        ]);
        //return->json();
       // dd($validate);


        $phoneNo = $request->input('mobileNo');
        $fName = $request->input('firstName');
        $lName = $request->input('lastName');


            /**/
                $user = User::create(  [
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

               // dd($user);
                $undergrad = UnderGrad::create([

                    'user_id'=>$user->id,
                    'examNo'=>$request->input('examNo'),
                    'highSchool'=>$request->input('highSchool'),
                    'graduationYear'=>$request->input('graduationYear'),
                    'majorName'=>$request->input('major'),
                    'locCounty'=>$request->input('locCounty'),
                    'locDistrict'=>$request->input('locDistrict'),
                    'collegeChoice'=>$request->input('collegeChoice'),
                    'schCategory'=>$request->input('schCategory'),
                    'numAttempts'=>$request->input('numAttempts'),
                    'eduLevel'=>$request->input('eduLevel')
                ]);

                $payment = Payment::create([
                            'user_id'=>$user->id,
                            'amntpaid'=>$request->input('amntpaid'),
                            'paydate'=>$request->input('paydate'),
                            'bankRecptNo'=>$request->input('bankRecptNo')
                        ]);


        //assign the student role with id 3 to the user
                $user->roles()->attach(3);

        //assign the user to a testing center
        //tcc = new TestingCenterController();
        //$tcc->assignTestingCenter($user->id);

        //trigger the ExamRegistration event and
        //email the user with the Details of his registration
        //and an assigned testing center

        //call the Moodle connection controller and create the user
        //in Moodle, then send their credentials via email.
 //dd($user);
        $mc = new MoodleConnectionController(new curl(), $user);

        //dd($mc);

        //create and enrol the student
      //  $erp = App::make(ExamRegistrationService::class);
       // dd($erp);
        //initialize the user property of the ExamRegistration Service Object
      //  $erp->user = $user;

       // try{
            $mc->enrollUnderGradStudent($phoneNo,$fName,$lName);
            //send email to student
          // event(new ExamRegistration($user));

            $this->sendMailApi($user);

           // $smsctrl = new SMSController($phoneNo,$fName,$lName);

           //   $smsctrl->sendSMSBiodataRegTwilio();
       // }
       // finally{
             //suppress the output of the function sendSMSMessage()
                ob_start();
                   $smsctrl = new SMSController($phoneNo,$fName,$lName);

                $smsctrl->sendSMSBiodataRegTwilio();
             //      $smsctrl->sendSMSMessage();
      //  }
               ob_end_clean();



            //send SMS notification


        //redirect
        //return redirect("http://ulentrance.ul.edu.lr/");
        return back()->with('success','Application successful!');
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


    public function sendMailApi(User $user = null)
    {


        # Instantiate the client.
        $mgClient = Mailgun::create('4499cdbe871e787a631542955b9bad39-9b1bf5d3-98082911', 'https://api.mailgun.net/v3/examregistration.ul.edu.lr');
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
    public function sendMail()
    {

     /*   //('max_execution_time', 900);
       // Mail::to(Auth::user()->email)->send(new ExamNotification());/* //

        $to_email = 'pmetieh@gmail.com';
        $subject = 'Testing PHP Mail';
        $message = 'This mail is sent using the PHP mail function';
        $headers = 'From: noreply@company.com';
        mail($to_email,$subject,$message, $headers);//,$headers
        return 'Email sent';
       // return redirect('/');
*/
        $user = Auth::user();
         // dd($user);
        $name = $user->firstName.' '.$user->lastName;
        $testingcenter = $user->testingcenter;
        //   dd($testingcenter);
        $user['name'] = $name;
        $user['tcName'] = trim($testingcenter[0]->centerName);
        $user['tcLocation'] = trim($testingcenter[0]->tcLocation);

       // dd($user->tcName);

         Mail::to($user->email, $name)->send(new \App\Mail\ExamNotification($user));//'pmetieh@gmail.com'$user->email'pmetieh@gmail.com'
            echo '<br>'.'Mail sent ...';


    }

    /**
      * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //check if the user is logged in
         if(Auth::check())
            {
               //get the user with id = $id
                $user = User::find($id);
                $u = $user->toArray();
              // dd($u);
               $grad = $user->undergrad;
               $payment = $user->payment;

              // dd($payment->toArray());
              // dd($grad);

               //add new keys to the $u array
               $u['ugradId'] = $grad->id;
               $u['examNo'] = $grad->examNo;
               $u['schCategory'] = $grad->schCategory;
               $u['eduLevel'] = $grad->eduLevel;
               $u['highSchool'] = $grad->highSchool;
               $u['graduationYear'] = $grad->graduationYear;
               $u['locDistrict'] = $grad->locDistrict;
               $u['locCounty'] = $grad->locCounty;
               $u['collegeChoice'] = $grad->collegeChoice;
               $u['majorName'] = $grad->majorName;
               $u['numAttempts'] = $grad->numAttempts;
               $u['bankRecptNo'] = $payment->bankRecptNo;
               $u['amntpaid'] = $payment->amntpaid;
               $u['paydate'] = $payment->paydate;
               $u['upaymentId'] = $payment->id;

             //  dd($u);
                return view('pages.editUgraddata', $u);
            }else
            return redirect('login');


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
        //         dd($request);
        $user = User::findOrFail($id);
         $user->update(
                   [

                    /*'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'password'=>bcrypt($request->input('password')), */
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

        $undergrad = UnderGrad::where('id', $request->input('ugradId'))->update([

                    'user_id'=>$user->id,
                    'examNo'=>$request->input('examNo'),
                    'highSchool'=>$request->input('highSchool'),
                    'graduationYear'=>$request->input('graduationYear'),
                    'majorName'=>$request->input('major'),
                    'locCounty'=>$request->input('locCounty'),
                    'locDistrict'=>$request->input('locDistrict'),
                    'collegeChoice'=>$request->input('collegeChoice'),
                    'schCategory'=>$request->input('schCategory'),
                    'numAttempts'=>$request->input('numAttempts'),
                    'eduLevel'=>$request->input('eduLevel')

        ]);

        $payment = Payment::where('id', $request->input('upaymentId'))->update(
            [
            'user_id'=>$user->id,
            'amntpaid'=>$request->input('amntpaid'),
            'paydate'=>$request->input('paydate'),
            'bankRecptNo'=>$request->input('bankRecptNo')
        ]);

        return 'Record updated';
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


        $row1Header = ["ExamNo","First Name","Other Name","Last Name","Date of Birth","High School",
                "Graduation Year","Gender","Location","College", "Major", "MobileNo"];
      //  dd(count($row1Header));
               // dd(chr(65));
        $char = 65;


        ///create a new Excel Workbook, represented by a spreadsheet object

        $spreadsheet = new Spreadsheet();//\PhpOffice\PhpSpreadsheet\
        //dd($spreadsheet);//Excel::setTitle("Testingcenter")
        ///create export object
        $sheet = $spreadsheet->getActiveSheet();
       // dd($sheet);
        //$sheet->setCellValue('A1','PHPSpreadSheet');

        for($i = 0; $i < count($row1Header); $i++)
        {
            //echo "".chr($char++).'1'."".' '.$row1Header[$i].'<br>';
            $sheet->setCellValue(chr($char++).'1', $row1Header[$i]);
        }

        $sheet->setTitle('UndergradEntranceExamReport2021');

        //get the list of undergrads
            $ugrads = UnderGrad::all();
            $ugradIds = array();
            $i = 0;

          //  dd($ugrads);
            //get the list of undergraduate Ids.


            foreach ($ugrads as $ug) {
                $ugradIds[$i++] = $ug->user_id;
            }
           // dd(count($ugradIds));

            //set the counter for the array index to continue from 1
                $k = 1;
             for($j = 0; $j < count($ugradIds); $j++)
             {


                    $u = User::find($ugradIds[$j]);
                  //  echo $u->undergrad->highSchool.'<br?';
               // dd($u->undergrad->examNo);

                $school = School::find($u->undergrad->highSchool)->schName;
                                  //return $school;
                                     $countyLocation = rtrim(County::find($u->undergrad->locCounty)->countyName);

                                    // dd($countyLocation);

                                    $graduationYear = $u->undergrad->graduationYear;
                                    $college = trim(College::find($u->undergrad->collegeChoice)->collegeName);
                                    $major = trim(Major::find($u->undergrad->majorName)->majorName);

                 $database[$k++] =  [$u->undergrad->examNo, $u->firstName,$u->otherName,$u->lastName, $u->dob,
                         $school, $graduationYear, $u->gender, $countyLocation,$college, $major, $u->mobileNo];

                //get the user corresponding with the selected Ids



             }//dd($k);
           // dd(count($database));
             //var_dump($database);

    //note $database is an array of arrays. Therefore we have to traverse it with an inner loop


    $j = 2;//row number; we are starting from the second row
    foreach($database as $db)
    {
        //echo '<b>'.$j++.' : '.'</b>';
        $char1 = 65; //ASCII value of A.

        for($i = 0; $i < count($db); $i++)
        {
           // echo $db[$i].'<br>';
           // echo chr($char1++).$j.'<br>';
             $sheet->setCellValue(chr($char1++).$j, $db[$i]);
        }
        $j++; //increment the row number outside the inner for loop
    }



        //create a Phpspreadsheet writer object
        //the writer object creates and saves an excel workbook file and
        //its associated spreadsheets.

        //pass in the new spreadsheet
        $writer = new Xlsx($spreadsheet);

        //save the spreadsheet to a file
        $writer->save('C:\xampp\htdocs\tc\storage\UnderGradEntranceExamRepo rt2018.xlsx');
        return 'Excel Spreadsheet Report has been created.';
    }

    public function regUndergrads()
    {
        return view('admin.registeredUndergrads');
    }
}
