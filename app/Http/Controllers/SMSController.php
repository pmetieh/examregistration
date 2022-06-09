<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
//use Nexmo\Message\Client;
//use Nexmo\Laravel\Facade\Nexmo;
//use Vonage\Client\Credentials;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $phoneNo;
    public $fName;
    public $lName;

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

   // public function __construct() {}

     public function __construct($_phoneNo, $_fName, $_lName)
    {
            $this->phoneNo = $_phoneNo;
            $this->fName = $_fName;
            $this->lName = $_lName;
          //  dd($this->phoneNo);
    }

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

    public function sendGeneralMessage(Request $request)
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

   public function formatPhoneNo($phoneNo = '')
    {
      //  $str = '+0881750921';//"0(212)-1 203-45 6_7";//;"Visit W3Schools";
       // echo 'Original string '.$str.'<br><br>';// = "(212)-123-4567"//;"Visit W3Schools";
        $pattern = "/w3schools/i";
     //   echo preg_match($pattern, $str); // Outputs 1


       // $str = 'P';//"Vi%sit+@ Microsoft-=*&!";
        $pattern1 = "/\W|\s|_/i";// remove puntuation spaces and underscore from the number
        $pattern2 = "/^0/"; //remove leading zero
        $pattern3 = "/\W|\s|_|^0/i";

        $newNo = '231'.preg_replace($pattern3, "", $phoneNo);
        echo 'New string '.$newNo;
        return $newNo;
         // W3Schools Outputs "Visit W3Schools!"
     }

    public function sendSMSMessage()
    {


          /*  //$phoneNumber = $request->input('phoneNumber');
            echo "Sending SMS ...";

            //get user mobile number
           // $usermobile = $user->mobileNo;

            $usermobile = "231881750921";//"231770502254";
            $message = "Thank you ".$this->fName.' '.$this->lName."! You have successfully registered for the entrance.";
            $sender = "UL Testing Center";

           $basic  = new \Vonage\Client\Credentials\Basic("e7405db2", "HxWfF67UIcy4DtUH");
           //  dd($basic);
            $client = new \Vonage\Client($basic);
           // dd($client);

            $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($usermobile, $sender, $message)
            );//231886546983

    */
    }

    public function receiveSMSMessage()
    {
        echo 'Incoming ...SMS';
    }

    public function smsdeliveryreports()
    {
        echo 'Incoming ...SMS delivery report';
      /*   $basic  = new \Vonage\Client\Credentials\Basic(VONAGE_API_KEY, VONAGE_API_SECRET);
        $client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

         @var \Vonage\SMS\Webhook\InboundSMS
        $inbound = \Vonage\SMS\Webhook\Factory::createFromGlobals();

        error_log($inbound->getText());
        $client->sms()->send(
            new \Vonage\SMS\Message\SMS($inbound->getFrom(), $inbound->getTo(), 'Thanks for sending a message!' )
        );*/
    }

    public function sendSMSMessageTwilio()
    {


            //$phoneNumber = $request->input('phoneNumber');
            echo "Sending SMS ...";

            //get user mobile number
           // $usermobile = $user->mobileNo;
            $phoneNo = $this->formatPhoneNo($this->phoneNo);

            $usermobile = $this->phoneNo; //"231881750921";//"231770502254";
            $message = "Thank you ".$this->fName.' '.$this->lName."! You have successfully registered for the UL entrance exam.";
            $sender = "UL Testing Center";

            $account_sid = 'AC39dfcb2ec6b8566cd0d237d668054d2d';//getenv("TWILIO_SID");
           // dd($account_sid);
            $auth_token = 'aa7c117ab7dc88443e92189c4e720b03'; //getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = "ULEntrancee";//StellaMari'12107746350';// 'UL Entrance Exam';//getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($phoneNo,
            ['from' => $twilio_number, 'body' => $message] );


    }

    public function sendSMSBiodataRegTwilio()
    {


            //$phoneNumber = $request->input('phoneNumber');
            echo "Sending SMS ...";

            //get user mobile number
           // $usermobile = $user->mobileNo;

            $phoneNo = $this->formatPhoneNo($this->phoneNo); 

            $usermobile = $this->phoneNo; //"231881750921";//"231770502254";
            $message = "Thank you ".$this->fName.' '.$this->lName."! Your BioData record has been created..";
            $sender = "UL Testing Center";

            $account_sid = 'AC39dfcb2ec6b8566cd0d237d668054d2d';//getenv("TWILIO_SID");
           // dd($account_sid);
            $auth_token = 'aa7c117ab7dc88443e92189c4e720b03'; //getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = "ULEntrance";//StellaMari'12107746350';// 'UL Entrance Exam';//getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
         //   dd($client);
            $client->messages->create($phoneNo,
            ['from' => $twilio_number, 'body' => $message] );


    }

                // Create a formatting functio


}

