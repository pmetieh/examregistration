<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\MobilePayment;
use App\MomoResponse;
use App\MomoBalance;
use App\Events\PaymentCompletion;
use App\Http\Controllers\SMSController;
use Illuminate\Auth;
class

MobilePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $xreferenceId; //for creating the ApiUser and as the user name in basic Authentication for the Access Token
    public $subscriptionKey;
    public $userName;
    public $apiKey;
    public $accessToken;
    public $tokenExpiryTime; //time tha access token expires
    public $amount;
    public $currency;
    public $externalId;
    public $payer; //json object (consists of partyId and partyIdType properties)
    public $partyIdType; //MSISDN
    public $partyId; // mobile number  eg. 231881750921
    public $payerMessage; // "Payment for Exam Registration Form",
    public $payeeNote; //"Sent by examregistration.ul.edu.lr"


    public function index()
    {
        //
        $amount = '2500';
        $currency = 'EUR';
        $phoneNumber = '231881750921';
        $description = "Sent by examregistration.ul.edu.lr";

        dd( "{".'"amount"'.':'.'"'.$amount.'"'.','
          .'"currency"'.':'.'"'.$currency.'"'.','
          .'"externalId"'.':'.'"'.mt_rand().'"'.','
          .'"payer"'.':'.'{'.
            '"partyIdType"'.':'. '"MSISDN"'.','
            .'"partyId"'.':'.'"'.$phoneNumber.'"'
          .'}'.','.
          '"payerMessage"'. ':'. '"Sent by examregistration.ul.edu.lr"'.','.
          '"payeeNote"'.':'.'"'.$description.'"'.
        '}');
    }

    /**
     * create a momo open api user to access the momo api collections Api
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->subscriptionKey = '99909e17a1394a2e8c51ad957204fddf';
    }
    public function testCurl()
    {
         $curl = curl_init();

           /* dd( array(
                'X-Reference-Id'.':'.$uuid,//1a7b0ffd-3ba6-4904-ba0c-c622130375e3
                'Ocp-Apim-Subscription-Key: 99909e17a1394a2e8c51ad957204fddf',
                'Content-Type: application/json'
            ));*/

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://google.com',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            //CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1));

             $response = curl_exec($curl);
//dd($curl);
           // echo $response;

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            echo "The response status code is ".$httpcode;
            echo '<br>';
            curl_close($curl);
    }

      public function create()
      {
         return view('pages.mobilepayment');
      }
    public function createApiUser()
    {

            //generate a new UUID


            $uuid = Str::uuid()->toString();
            $this->xreferenceId = $uuid;

          //  $this->testCurl();

           // dd($uuid);
            $curl = curl_init();

          // dd( array(
         //       'X-Reference-Id'.':'.$uuid,//1a7b0ffd-3ba6-4904-ba0c-c622130375e3
          //      'Ocp-Apim-Subscription-Key: 99909e17a1394a2e8c51ad957204fddf',
         //       'Content-Type: application/json'
           // ));

             curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.momodeveloper.mtn.com/v1_0/apiuser',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "providerCallbackHost":"https://examregistration.ul.edu.lr/momocallback/callback.php"
            }',
            CURLOPT_HTTPHEADER => array(
                'X-Reference-Id'.':'.$this->xreferenceId,//$uuid 6af8c646-820a-4cc9-82c4-4e04dc5d3efa /1a7b0ffd-3ba6-4904-ba0c-c622130375e3
                'Ocp-Apim-Subscription-Key:'.$this->subscriptionKey,
                'Content-Type: application/json'
            ),
            ));



            $response = curl_exec($curl);
//dd($curl);
           // echo $response;


            //dd($response);

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


           /**/ if($httpcode == 201){

                // echo $response;
                 echo "The response status code is ".$httpcode.'Api User created'.'<br>';
                 echo '<br';
                 return $uuid;
            }

        curl_close($curl);
    }

    public function getApiUserKey()//$uuid
    {
//6af8c646-820a-4cc9-82c4-4e04dc5d3efa
            //dd($uuid);
           // dd('https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/'.$uuid.'/apikey');
            //$uuid = $this->createApiUser();
              $this->createApiUser(); //generate the referenceId for the new user
              $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/'.$this->xreferenceId.'/apikey',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_HTTPHEADER => array(
                'Ocp-Apim-Subscription-Key:'.$this->subscriptionKey,
                'Content-Length:0'
              ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                         echo "The response status code is ".$httpcode.'<br>';
                 if($httpcode == 201){
                 //   echo '<br>';

                //var_dump(json_decode($response)) ;
                    $apiKey = json_decode($response);
                   // echo '<br>';
                   // echo 'Api key '.$apiKey->apiKey;
                    $momoApiKey = $apiKey->apiKey;
                    $this->apikey = $momoApiKey;

                 return [
                            'userName' => $this->xreferenceId,
                            'momoApiKey'=> $momoApiKey
                        ];
            }

            curl_close($curl);
            //echo $response;*/

    }

    public function getAccessToken()
    {

        $cred = $this->getApiUserKey();
        $userName = $cred['userName'];
        $passwd =   $cred['momoApiKey'];



       // $basicAuth =  base64_encode("$userName:$passwd");
        $basicAuth =  base64_encode($this->xreferenceId.':'.$this->apikey);
       // dd($basicAuth);
        //var_dump($cred['momoApiKey']);
       // var_dump($cred['userName']);

            /*'Authorization: Basic MWE3YjBmZmQtM2JhNi00OTA0LWJhMGMtYzYyMjEzMDM3NWUzOmFmNjRkODcyYjgzNDRjOWRiOWNlMjdjYmY3YTYzNzM5'*/
                    $curl = curl_init();


                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://sandbox.momodeveloper.mtn.com/collection/token/',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded',
                        'X-Target-Environment: sandbox',
                        'Ocp-Apim-Subscription-Key:'.$this->subscriptionKey,
                        'Authorization: Basic '.$basicAuth,
                        'Content-Length:0'
                      ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $auth = json_decode($response);
                  //  var_dump($auth);

                    $accessToken = $auth->access_token;
                    $expiryTime = $auth->expires_in;

                    //set the Access token for the transaction
                    $this->accessToken = $accessToken;
                    $this->tokenExpiryTime = $expiryTime;


                          echo '<br>';
            echo 'Access Token '.$this->accessToken;

            return [
                            'accessToken' => $accessToken,
                            'expiryTime'  => $expiryTime
                          ];
    }

    public function requestToPay(Request $request)
    {
        $request->validate([
            "firstName" => 'required|string',
            "lastname" => 'required|string',
            "email" => 'required|email',
            "phoneNumber" => 'required|numeric',
            "description" => 'required|string',
            "amount" => 'required|numeric',
            "currency" => 'required|string'
        ]);

        $fName = $request->input('firstName');
        $lName = $request->input('lastname');
        $email = $request->input('email');
        $phoneNumber = $request->input('phoneNumber');
        $description = $request->input('description');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        //$amount = $request->input('amount');

        $post = [
                'fName'=>$fName,
                'lName'=>$lName,
                'email'=>$email,
                'moNumber'=>$phoneNumber,
                'description'=>$description
            ];


        $mpayment = MobilePayment::create([
            'fName' => $fName,
            'lName'=> $lName,
            'email' => $email,
            'mobileNo' => $phoneNumber,
            'amntpaid' => $amount,
            'currency' => $currency,
            'description' => $description

        ]);
       // dd($mpayment);

        $authCred = $this->getAccessToken();
        $bearerToken = $authCred['accessToken'];
        //var_dump($authCred);
       // dd('Authorization: Bearer '.$bearerToken);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "{".'"amount"'.':'.'"'.$amount.'"'.','
          .'"currency"'.':'.'"'.$currency.'"'.','
          .'"externalId"'.':'.'"'.mt_rand().'"'.','
          .'"payer"'.':'.'{'.
            '"partyIdType"'.':'. '"MSISDN"'.','
            .'"partyId"'.':'.'"'.$phoneNumber.'"'
          .'}'.','.
          '"payerMessage"'. ':'. '"Sent by examregistration.ul.edu.lr"'.','.
          '"payeeNote"'.':'.'"'.$description.'"'.
        '}',
          CURLOPT_HTTPHEADER => array(
            'X-Reference-Id: '.$this->xreferenceId,
            'X-Target-Environment: sandbox',
            'Ocp-Apim-Subscription-Key: '.$this->subscriptionKey,
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->accessToken
          ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        //if payment was successful
        if($httpcode == 202)
        {
            $user = \Auth::user();
            //send notification sms or email
            echo '<br><br>requestToPay '.$httpcode.' Payment Accepted'.'<br><br>';
            $this->getBalance();
            $this->getPaymentStatus();

            //check if the person has applied before by checking for the existence of the email address
            //if he / she has a previous registration redirect them to ulentrance.ul.edu.lr
            //return redirect('http://examregistration.ul.edu.lr/home');

            //if they are registering for the first time, redirect thenm to the BioData forms
            //return redirect('http://ulentrance.ul.edu.lr/home');

            $smsctrl = new SMSController($phoneNumber,$fName,$lName);

            if($user == null)
            {
                //send SMS notification

                // $smsctrl->sendSMSMessage();
                try{
                    $smsctrl->sendSMSMessageTwilio();
                }
                finally{
                    event(new PaymentCompletion($post));
                    return back()->with('info','Mobile payment successful!');
                }
            }
            if($user->hasAnyRole('student'))
            {
                    //send SMS notification

           // $smsctrl->sendSMSMessage();
                try{
                    $smsctrl->sendSMSMessageTwilio();
                }
                finally{
                    event(new PaymentCompletion($post));
                    return back()->with('mobilepay','Mobile payment successful! Your Login credentials was sent to your email!');
                }
            }



        }
        else
        {
            //send notification sms or email
            echo '<br><br>requestToPay tranction failed '.$httpcode.'  '.curl_error($curl);
            return back()->with('error','Mobile payment not successful, please try again!');
        }
        curl_close($curl);



    }

    public function getBalance()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.momodeveloper.mtn.com/collection/v1_0/account/balance',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Ocp-Apim-Subscription-Key: '.$this->subscriptionKey,
            'X-Target-Environment: sandbox',
            'Authorization: Bearer '.$this->accessToken
          ),
        ));

        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpcode == 200)
        {
            echo '<br><br>getBalance Response code '.$httpcode;
            echo '<br>';
            $balance = json_decode($response);
            var_dump($balance);
            echo '<br>';
            $finalBal = $balance->availableBalance;

            $momBal = MomoBalance::create([
                'balance'=>$finalBal
            ]);
            echo '<br><br>The balance is <br><br>'.$finalBal;
        }
        else
        {
                    echo '<br>';
                    echo curl_error($curl);
                    echo curl_getinfo($curl, CURLINFO_HTTP_CODE);

                    echo '<br>';


        }
        curl_close($curl);

       // ;$this->getPaymentStatus();

    }

    public function getPaymentStatus()
    {

    $curl = curl_init();

          curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay/'.$this->xreferenceId,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Ocp-Apim-Subscription-Key:'.$this->subscriptionKey,
            'X-Target-Environment: sandbox',
            'Authorization: Bearer '.$this->accessToken
          ),
        ));

    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if($httpcode == 200)
        {
            //send an sms or email and record the response
            echo '<br><br>';
            $statusObj = json_decode($response);
           // var_dump($statusObj);
            $momoResp = MomoResponse::create([
                'amount' =>$statusObj->amount,
                'currency'=>$statusObj->currency,
                'payeeNote'=>$statusObj->payeeNote,
                'referenceNo'=>$statusObj->externalId,
                'financialTransactionId'=>$statusObj->financialTransactionId,
                'phoneNo'=>$statusObj->payer->partyId,
                'status'=>$statusObj->status

            ]);

           // dd($momoResp);

        }

    curl_close($curl);
  //  echo $response;






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
    public function show()
    {
        $response = '{"apiKey":"435b8e890bc44f0f9f93ed5ad712e26e"}';
        var_dump($response);
        echo '<br>';
        $json = json_encode($response);
        echo '<br>';
        var_dump($json);
        echo '<br>';
        echo json_decode($json, true);
        echo '<br>';
        var_dump(json_decode($json));
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
}
