<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class SchoolController extends Controller
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
        return view('admin.addHighSchool');
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $sch = School::create([
            'schName'=>$request->input('schName'), 
            'schLocation'=>$request->input('schLocation')
        ]);
        return 'School added';
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
    public function edit()
    {
        // show the edit form
        return view('admin.editHighSchool');
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
        dd($request);
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

    public function insert_sch()
    {
        //$contents = File::get(storage_path('countries_sql.sql'));
        $file = fopen(storage_path('LKUPHighSchName_1.sql'), 'r');
        //dd($file);
        $i = 0;
        while(! feof($file))
              {
                //get a line from the file
                $str1 = fgets($file);

                //get the position of the seperating comma
                $end = strpos($str1,",",0);
                
               /* echo 'string position '.$end.'<br/>';
                echo $str1.'<br/>';*/

                //extraxt the school name, it comes before the comma
                $schName = substr($str1, 0, $end);

                //start after the comma and select the location
                $schLocation = substr($str1, $end +1);
               /* echo $schName. "<br />";
                echo $schLocation."<br /><br/>";
*/
                /* */ 
                 $c = School::create([
                'schName'=>$schName,
                'schLocation'=>$schLocation
                 ]);
                $i++;
              }

            fclose($file);

            return $i++.'  Schools added ';
            
    }

    public function getHighSchoolLoc($id)
    {
        $school = School::findOrFail($id);

        echo json_encode(rtrim($school->schLocation));

    }
}
