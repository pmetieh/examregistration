<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Events\PaymentCompletion;
use DB;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SMSController;
use Exception;
use Illuminate\Auth;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // echo 'Authenticating Users...';

         //get the authenticated user

       // return view('admin.dashboard');
        $user =  \Auth::User();
       // dd($user->hasAnyRole('student'));
       // dd($user);
       //un authentecated users
        if($user == null)
            return view('pages.index_payment');//redirect('login');

        if($user->hasRole('admin')) //has filled a biodata form before
        {
            return view('admin.dashboard');

        }

        elseif($user->hasRole('student'))
        {
            return view('pages.index_payment');//cardpayment
            //return view('pages.index_payment');
            //return 'Role student';//view('admin.dashboard');
        }
        else
        {
            return redirect('/');
        }



        //return view('pages.index_payment');
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

    public function cardpayview()
    {
        //
        return view('pages.cardpayment');
    }

    public function cardpay(Request $request)
    {
        /*$request->validate(
            ["description" => 'required|string',
            "noOfItems" => 'required|integer',
            "cvvCode" => 'required|integer',
             "year" => 'required|integer',
            "month" => 'required|string',
            "cardnumber" => 'required|integer']);
            */

            //  dd($request);
        $request->validate([
            "phoneNumber" => 'required',
            "customerFirstName" => 'required|string',
            "customerLastname"=> 'required|string',
            "customerEmail" => 'required|email',
            "phoneNumber" => 'required|integer',
            "amount" => 'required|integer',
            "referenceNumber" => 'required|integer',
            "curCode" => 'required|integer']);


        $phoneNo = $request->input("phoneNumber");
        $fName = $request->input("customerFirstName");
        $lName = $request->input("customerLastname");
        $email = $request->input("customerEmail");
        $refNo = $request->input("referenceNumber");
        $desc = $request->input("description");
        $date = $request->input("date");
        $cur = $request->input("countryCurrencyCode");
        $noItems = $request->input("noOfItems");
        $amnt = $request->input("amount");

      $post = array(
            "merchantId" => 'CIPG_MERCHANTID',
            "description" => $desc,
            "total" => $amnt * $noItems,
            "date" => $date,
            "countryCurrencyCode" => $cur,
            "noOfItems" => $noItems,
            "fName" => $fName,
             "lName" => $lName,
             "email" => $email,
             "moNumber" => $phoneNo,
             "referenceNumber" => $refNo,
             "serviceKey" => "CIPG_SERVICEKEY");

       $this->authorizeCreditCard($request);


        //after payment, get the authenticated user
         $user =  \Auth::User();
         if($user == null)
         {
            //if there is no authenticated user
            //then this is a first time registration
            //redirect to the home page
            //send a payment notification to the student
                 event(new PaymentCompletion($post));
                //send an SMS payment Notification

                 $smsctrl = new SMSController($phoneNo,$fName,$lName);
                 //$smsctrl->sendSMSMessage();
                 try{
                  $smsctrl->sendSMSMessageTwilio();
                 }
                 catch(Exception $e){

                 }
                 finally{
                    return back()->with('info', 'Your card payment was successful');
                 }

         }

        /*
            check if the email address is registered. If yes, this means that the applicant has applied before
            check what role the user has
            if the role is student then, that user has taken the test at least once redirect the user to the exam page.
        */

        if($user->hasAnyRole('student'))
        {
            //send a payment notification to the student
                // event(new PaymentCompletion($post));

           // return redirect("https://ulentrance..ul.edu.lr");
           return back()->with('cardpay','Debit/Credit Card payment successful! Please check your email for Login credentials.');
        }

/*
        $email =  $request->input("customerEmail");
        $post = array(
            "merchantId" => 'CIPG_MERCHANTID',
            "description" => $request->input("description"),
            "total" => $request->input("amount") * $request->input("noOfItems"),
            "date" => $request->input("date"),
            "countryCurrencyCode" => $request->input("countryCurrencyCode"),
            "noOfItems" => $request->input("noOfItems"),
            "customerFirstName" => $request->input("customerFirstName"),
             "customerLastname" => $request->input("customerLastname"),
             "customerEmail" => $request->input("customerEmail"),
             "customerPhoneNumber" => $request->input("customerPhoneNumber"),
             "referenceNumber" => $request->input("referenceNumber"),
             "serviceKey" => "CIPG_SERVICEKEY");

              $ch = curl_init();

             //dd($ch);
              //  dd($ch);
        //The variable -- CIPG_URL_REGISTER_POST is being declared in the settings.php file included
             //CIPG_URL_REGISTER_POST_PARAM = "https://ucollect.ubagroup.com/cipg-payportal/regptran";
             $REGISTER_CIPG_TXN_URL = "https://ucollect.ubagroup.com/cipg-payportal/regptran";

            //set option of URL to post to

            curl_setopt($ch, CURLOPT_URL, $REGISTER_CIPG_TXN_URL);
            //set option of request method -----HTTP POST Request

            curl_setopt($ch, CURLOPT_POST, true);

            //The HTTP authentication methods to use

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

            //set to true if cipg url is via https

             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            //This line sets the parameters to post to the URL
              curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            //This line makes sure that the response is gotten back to the $response object(see below) and not echoed

              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //dd($ch);
                //This line excecutes the RPC call

              //  $response = curl_exec($ch);
                //dd($response);
            //and assigns the result to $response object

             //   $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

               // dd('Return code '.$returnCode);
            //Close the stream
              curl_close($ch);
              //Check if there are no errors ie httpresponse == 200 -OK
              $returnCode=200;
              if ($returnCode == 200) {
                $response = 99999;
                //If there are no errors, the transaction ID is returned
                 $transactionid = $response;
                 //dd($response);

                 //save the transaction Id
                 DB::table('txnref')->insert(['email'=>$email,
                'txnId'=>$transactionid]);//txnId

                 //this transaction Id will later be sent to the student in the
                 //ExamNotification mail.

                 //This line declares the Link to pay for this transaction
                //$paylink = CIPG_URL_PAY ."?id=" . $transactionid; header( "Location: $paylink");


                 //send a payment notification to the student
                // event(new PaymentCompletion($post));

                //check if the logged in user has the student role. If He does, then redirect them to the Actual testing poage after payment

                  //  dd(\Auth::User());
               // $this->checkRole();



                    if($user = \Auth::check())
                        {
                            echo 'logged in';
                        }else{
                            echo 'not logged in';
                            return redirect('inputdata');
                        }

                    $user =  \Auth::User();

                    if($user->hasRole('student'))
                      {
                         return redirect('http://34.72.245.179');
                      }


                 //redirect to the input form
                 //
                 //return redirect('/home');
            }
            else
              {
               //Get return Error Code, If there was an error during call //
               switch($returnCode){
                    //200 is OK so, this should be insignificant if all is well
                    case 200: break;

                    default: $result = 'HTTP ERROR -> '. $returnCode; //Declare the Request Error
                               echo $result;
                               break ;
               }

             }


            //redirect the user to the home page
*/

    }

    public function checkRole()
    {
        $user =  \Auth::User();

        return 'Role Student';

        if($user->hasRole('student'))
        {
            return redirect('examregistration.ul.edu.lr');
        }
        else
        {
             return redirect('inputdata');
        }
       // dd($user);
       /* if($user == null)
            return redirect('login');
        if($user->hasRole('admin'))
        {
            return view('admin.dashboard');

        }*/


    }

    public function authorizeCreditCard(Request $request)
    {
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName("824zNd7GK");
        $merchantAuthentication->setTransactionKey("87q72R5sR92UE5rN");



       // dd($_request);

        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card

        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($request->input('cardnumber'));///"4111111111111111"
        $expirationDate = $request->input('month').'-'.$request->input('year');
        $creditCard->setExpirationDate($expirationDate);//"2038-12"
        $creditCard->setCardCode($request->input('cvvCode'));//"123"


        //dd($creditCard);
        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
      //  dd($paymentOne);
        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber("10101");
        $order->setDescription("Entrance Exam Payment");

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($request->input('customerFirstName'));
        $customerAddress->setLastName($request->input('customerLastname'));
        $customerAddress->setPhoneNumber($request->input('customerPhoneNumber'));
        //$customerAddress->setCompany("Souveniropolis");
        //$customerAddress->setAddress("14 Main Street");
        //$customerAddress->setCity("Pecan Springs");
        //$customerAddress->setState("TX");
        //$customerAddress->setZip("44628");
        $customerAddress->setCountry("Liberia");

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId("99999456654");
        $customerData->setEmail($request->input('customerEmail'));

          // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        $merchantDefinedField1 = new AnetAPI\UserFieldType();
        $merchantDefinedField1->setName("customerLoyaltyNum");
        $merchantDefinedField1->setValue("1128836273");

        //$merchantDefinedField2 = new AnetAPI\UserFieldType();
        //$merchantDefinedField2->setName("favoriteColor");
       // $merchantDefinedField2->setValue("blue");

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authOnlyTransaction");
        $transactionRequestType->setAmount($request->input('amount'));
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        //$transactionRequestType->addToUserFields($merchantDefinedField1);
        //$transactionRequestType->addToUserFields($merchantDefinedField2);



        $_request = new AnetAPI\CreateTransactionRequest();
        $_request->setMerchantAuthentication($merchantAuthentication);
        $_request->setRefId($refId);
        $_request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
     $controller = new AnetController\CreateTransactionController($_request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);



    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {
                echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
            } else {
                echo "Transaction Failed \n";
                if ($tresponse->getErrors() != null) {
                    echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                    echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                }
            }
            // Or, print errors if the API request wasn't successful
        } else {
            echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getErrors() != null) {
                echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }
    } else {
        echo  "No response returned \n";
    }

     return $response;

   }
   public function paymobilemoney()
   {

        // This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
       // require_once 'HTTP/Request2.php';

      //  $response = Http::get('https://reqres.in/api/users?page=2');

      //  echo
     //   dd($response->json());
        //https://sandbox.momodeveloper.mtn.com/collection/oauth2/v1_0/userinfo
            $curl = curl_init();
            $url = "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser";//https://reqres.in/api/users?page=2";
             curl_setopt($curl, CURLOPT_URL, $url);
             curl_setopt($curl, CURLOPT_POST);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $resp = curl_exec($curl);

            $headers = array(
            // Request headers
            'Authorization' => '',
            //'X-Callback-Url' => '',
           // 'X-Reference-Id' => '',
            'X-Target-Environment' => '',
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => '{99909e17a1394a2e8c51ad957204fddf}',
        );

             if($e = curl_error($curl))
                 {
                  echo $e;
                 }
                 else
                 {
                    $decoded = json_decode($resp);
                    print_r($decoded);
                  }

                  curl_close($curl);
       /* $request = new Http_Request2('https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay');
        $url = $request->getUrl();

        $headers = array(
            // Request headers
            'Authorization' => '99909e17a1394a2e8c51ad957204fddf',
            'X-Callback-Url' => '',
            'X-Reference-Id' => '',
            'X-Target-Environment' => '',
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => '{d515d79d5388450e9fa894ef81675500}',
        );

        $request->setHeader($headers);

        $parameters = array(
            // Request parameters
        );

        $url->setQueryVariables($parameters);

        $request->setMethod(HTTP_Request2::METHOD_POST);

        // Request body
        $request->setBody("{body}");

        try
        {
            $response = $request->send();
            echo $response->getBody();
        }
        catch (HttpException $ex)
        {
            echo $ex;
        }
        */

   }//


}

