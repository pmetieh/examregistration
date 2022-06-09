<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
class UniController extends Controller
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

    public function insert_uni()
    {
        

        //$contents = File::get(storage_path('countries_sql.sql'));
        $file = fopen(storage_path('LKUPInstitution_University.sql'), 'r');
        //dd($file);
        $i = 0;
        while(! feof($file))
              {
                //get a line from the file
               $str1 = fgets($file);

                //get the position of the seperating comma
                $end = strpos($str1,",",0);
                
               /* echo 'string position '.$end.'<br/>';*/
                echo $str1.'<br/>';

                //extraxt the school name, it comes before the comma
                 $uniName = substr($str1, 0, $end);

                //start after the comma and select the location
                 $uniLocation = substr($str1, $end +1);
               /* echo $uniName.'<br />';
                echo $uniLocation.'<br /><br/>';*/
            
                
                 /**/
                 $c = University::create(
                    [
                    'uniName'=>$uniName, 
                    'uniLocation'=>$uniLocation
                    ]);
                $i++;
              }

            fclose($file);

            return $i++.'  Universities added ';
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
