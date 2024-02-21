<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
//use Illuminate\Auth;
use Illuminate\Support\Facades\Auth;
//use App\Classes\ExamRegistrationService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

//////////////////Grade Results///////////////////////////////////////////////////////////////////////////////

Route::get("getallgrades/{id}", "GradesResultsController@get_all_grades_local");
Route::get('getenrolledusers/{id}', "GradesResultsController@get_enrolled_users");

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('apimail', 'UGradController@sendMailApi');


use App\Http\Controllers\UgradController;
//Auth::routes();
Route::get("sms", "SMSController@sendSMSMessageTwilio");

Route::get('createmoodleuser', 'MoodleConnectionController@createmoodleuser');
Route::get('mobilemoneypayment', 'MobilePaymentController@create');
Route::get('momoIndex', 'MobilePaymentController@index');

Route::get('createMomoApiUser', "MobilePaymentController@createApiUser");
Route::get('getMomoApiKey', "MobilePaymentController@getApiUserKey");
Route::get('getMomoAccessToken', "MobilePaymentController@getAccessToken");
Route::post('makeMomoPayment', "MobilePaymentController@requestToPay");
Route::get('testjson', "MobilePaymentController@show");


/*Route::get('app', function(ExamRegistrationService $_erp){

//	dd($this);
dd(app());
		//$erp = $_erp;
		$erp = App::make(ExamRegistrationService::class);
	dd($erp);
});

Route::get('getStudentRole', function(){

	$role = \App\Role::where('name', 'student')->get();
	dd($role[0]->id);


	//return "Logged in with student role";
});
*/
Route::resource('_ugrad', 'UGradController');

Route::get('/home', 'BioDataController@index')->name('home');
//Route::get('/', 'BioDataController@index');
Route::get('/', 'PaymentController@index');

	//function(){return redirect('adminDashboard');
	//return \Auth::User()->firstName.' is Logged in';}
//



Route::get('moodle','MoodleConnectionController@index');
Route::get('moodleuser','MoodleConnectionController@getUserDetails');


/////////////////////UngerGraduates///////////////////
Route::get('inputdata', 'UGradController@create');
Route::post('savedata', 'UGradController@store');
Route::get('editdata/{id}', 'UGradController@edit');

/*Route::get('editdata/{id}', function(){

			  if(Auth::check() && Auth::id() != 1)
			    return redirect()->action('ed', ['id'=>Auth::id()]);// ed
			  else
		             return redirect('login');
		});*/
Route::post('updatedata/{id}', 'UgradController@update');
///////////////////////////////////////////////////////////

/* Route::get('contactus', function(){
	return view('pages.page-contact-us');
}); */
///////////////////Graduates////////////////////////////
Route::get('inputgraddata', 'GradController@create');
Route::post('savegraddata', 'GradController@store');
Route::get('editgraddata/{id}', 'GradController@edit');
Route::post('updategraddata{id}', 'GradController@update');
//////////////////// /////////////////////////////////////




///////////////Admin Routes////////////////////////////
Route::get('excelgrad', 'GradController@exceldata');
Route::get('excelugrad', 'UGradController@exceldata');
///////////////////////////////////////////////////////


Route::get('regUgrad', 'UGradController@regUndergrads');
Route::get('regGrad', 'GradController@regGrads');
Route::get('email', 'UGradController@sendMail'); /*function()
{
	echo "Email route ...";
	dd(Auth::user()) ;
});//*/



Route::get('adminDashboard', 'AdminController@index');
Route::get('getfile', 'CountryController@getcountries');
Route::get('insertSch', 'SchoolController@insert_sch');
Route::get('insertMajors', 'MajorController@insert_majors');
Route::get('insertUni', 'UniController@insert_uni');
Route::get('insertTc', 'TestingCenterController@insert_tc');
Route::get('insertcollege', 'CollegeController@insertcollege');
Route::get('insertCounty', 'CountyController@insertCounties');
Route::get('insertDistrict', 'DistrictController@insertDistricts');
Route::get('getDistricts/{id}', 'DistrictController@getDistricts');
Route::get('_getDistricts/{id}', 'DistrictController@getDistricts');




Route::get('roleassignment', 'AdminController@index');
Route::get('assignrole', 'AdminController@assignroleview');
Route::post('assignrole', 'AdminController@assignrole');
Route::get('createroleview', 'AdminController@createroleview');
Route::post('createrole', 'AdminController@createrole');
Route::get('deleteroleview', 'AdminController@deleteroleview');
Route::post('deleterole/{id}', 'AdminController@deleterole');



////////////////////Testing Center////////////////////////////
Route::get('addtc', 'TestingCenterController@create');
Route::get('droptc', 'TestingCenterController@destroy');
Route::get('edittc', 'TestingCenterController@showeditView');
Route::post('updatetc', 'TestingCenterController@update');
Route::post('addcenter', 'TestingCenterController@store');
/* Route::get('addDateView', function(){
	return view('admin.setDateView');
}); *///'TestingCenterController@dateView'
Route::post('addDate', 'TestingCenterController@addDate');
Route::post('editDate', 'TestingCenterController@editDate');

Route::get('tcDetails/{id}', 'TestingCenterController@edit');
Route::get('assignTc/{id}', 'TestingCenterController@assignTestingCenter');

///////////////////////////////////////////////////

///////////////////////College / HighSchool///////////////////////////////
Route::get('addCollege', 'CollegeController@create');
Route::post('addCollege', 'CollegeController@store');
Route::get('editCollege/{id}', 'CollegeController@edit');
Route::post('updateCollege', 'CollegeController@update');
Route::get('dropCollege/{id}', 'CollegeController@destroy');

Route::get('addHSch', 'SchoolController@create');
Route::post('addHSch', 'SchoolController@store');
Route::get('editHSch', 'SchoolController@edit');
Route::post('updateHSch', 'SchoolController@update');
Route::get('dropHSch/{id}', 'SchoolController@destroy');
Route::get('getHSchLoc/{id}', 'SchoolController@getHighSchoolLoc');

Route::get('cardpay', 'PaymentController@cardpayview');
Route::post('postpayment', 'PaymentController@cardpay');
Route::get('_postpayment', 'PaymentController@cardpay');
Route::post('setExamDate', 'ExamDateController@store');

/* Route::get('adminDashboard/schooldistChart', function(){
	return view('reports.schoolDistribution');
}); */

///Office 365 SignIn
Route::get('/signin', 'AuthController@signin');
Route::get('/callback', 'AuthController@callback');
Route::get('/signout', 'AuthController@signout');
Route::get('/sendsms', 'SMSController@sendSMSMessage');
Route::get('/receivesms', 'SMSController@receiveSMSMessage');
Route::get('/smsdeliveryreports', 'SMSController@smsdeliveryreports');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
