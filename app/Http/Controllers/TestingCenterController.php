<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TestingCenter;
use App\User;

class TestingCenterController extends Controller
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
        return view('admin.createtestcenter');
    }

    public function assignTestingCenter($id)
    {

    	//$tcCon = new TestingCenterController();
    	//check if testing center is filled

        $tcs = TestingCenter::all();

        foreach ($tcs as $tc) {

        	if(!$this->tcIsFull($tc->id))
	    	{
	    		//step 1 
	    		//add the  to the assignment table
	    		/**/
	    		//dd($tc);
	    		DB::table('testing_center_user')->insert(['user_id'=>$id, 'testing_center_id'=>$tc->id]);//assigntc
	    		//update the testing_centers model table
	    		//increase the number of people assigned to the center

	    		$tc->noAssigned += 1;

	    		//checked if the capacity has been reached
	    		$diff = $tc->capacity - $tc->noAssigned;
	    		//if its filled set the filled filed to 1
	    		if($diff == 0)
	    		{
	    			$tc->filled = 1;

	    		}
	    		$tc->save();
	    	//	dd($tc);
	    		break;
	    	}
        }
    	
    }

    public function tcIsFull($tcId)
    {
    	if(!is_null($tcId))
    	{
    		$tc = TestingCenter::findOrFail($tcId);
    		//see if the filled = 1 return true
    		if($tc->filled == 1)
    			return true;
    		else 
    			return false;
    	}
    }


    public function insert_tc()
    {
        

        //$contents = File::get(storage_path('countries_sql.sql'));
        $file = fopen(storage_path('LKUPExamCenter.sql'), 'r');
        //dd($file);
        $i = 0;
        while(! feof($file))
              {
                //get a line from the file
               $str1 = fgets($file);

                //get the position of the seperating comma
              //  $end = strpos($str1,",",0);
                
               /* echo 'string position '.$end.'<br/>';*/
               // echo $str1.'<br/>';

                //extraxt the school name, it comes before the comma
                 //$centerName = substr($str1, 0, $end);
                $centerName = $str1;

                //start after the comma and select the location
                // $uniLocation = substr($str1, $end +1);
               /* echo $uniName.'<br />';
                echo $uniLocation.'<br /><br/>';*/
            
                
                 /**/
                 $c = TestingCenter::create(
                    ['centerName'=>$centerName]
                );
                $i++;
              }

              return $i.'Exam centers added';
          }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        ///create a new testing center 
        $tc = new TestingCenter();
        $tc->centerName = $request->input('centername');
        $tc->tcLocation = $request->input('location');
        $tc->capacity = $request->input('capacity');
        $tc->noAssigned = 0;
        $tc->filled = 0;
        $tc->save();

        return 'Testing center '.$tc->centerName.' successfully created';
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
        $tcs = TestingCenter::findOrFail($id);
        $tcarray = $tcs->toArray();

        echo json_encode($tcarray);

    }

    public function showeditView()
    {
        //
        return view('admin.edittestcenter');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
     //   dd($request);
        //get the appropiate testing center
        $tc = TestingCenter::findOrFail($request->input('centername'));
        $tc->capacity = $request->input('capacity');
        $tc->tcLocation = $request->input('location');
        $tc->save();

        //dd($tc);
        //go back to the original form
        return redirect()->back();
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

    public function addDate(Request $request)
    {
        //
        $examdate = ExamDate::create(['examDate'=>$request->input('examDate'), 
            'examTime'=>$request->input('examTime')]);
    }
    public function addTime()
    {
        //
    }

    public function dateView()
    {
        //
        return view('admin.setDateView');
    }
}
