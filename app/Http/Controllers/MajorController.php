<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Major;

class MajorController extends Controller
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

     public function insert_majors()
    {
        //$contents = File::get(storage_path('countries_sql.sql'));
        $file = fopen(storage_path('LKUPMajor.sql'), 'r');
       // dd($file);
        $i = 0;
        while(! feof($file))
              {
                //get a line from the file
                $majorName = fgets($file);

                //get the position of the seperating comma
               //$end = strpos($str1,",",0);
                
               /* echo 'string position '.$end.'<br/>';
                echo $str1.'<br/>';*/

                //extraxt the school name, it comes before the comma
               // $schName = substr($str1, 0, $end);

                //start after the comma and select the location
               // $schLocation = substr($str1, $end +1);
               /* echo $schName. "<br />";
                echo $schLocation."<br /><br/>";
*/             
                /* */ 
                 $c = Major::create([
                'majorName'=>$majorName
                 ]);
                $i++;
              }

            fclose($file);

            return $i++.'  Majors added ';
            
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
}
