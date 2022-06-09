<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\County;
use App\District;

class DistrictController extends Controller
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

    public function insertDistricts()
    {
                $file = fopen(storage_path('districts.csv'), 'r');
                // dd($file);
                $i = 0;

                $countyArray = array();

                //get the list of counties
                $counties = County::all();
                $countiesToArray = $counties->toArray();
                $allcounties = array();

                foreach ($counties as $key) {
                    # code...
                    $allcounties[$key->id] = rtrim($key->countyName);
                }
               
                 // dd($counties);
                 //dd($allcounties);
                // dd($file);

  
                 

            // echo '<b>'.$c->countyName.'</b><br/>';
                //compare the conty name from the Counties table with the one from the file
               while(!feof($file))
                      {
                        //get a line from the file
                        $str1 = fgets($file);

                        //get the position of the seperating comma
                        $end = strpos($str1,",",0);
                        
                       /* echo 'string position '.$end.'<br/>';*/
                       //echo $str1.'<br/>';

                        //extraxt the county name, it comes before the comma
                         $countyName = substr($str1, 0, $end);
                       //  echo '<h2>'.$countyName.' from file '.'</h2><br/>';
                         //$countyName = $str1;
                      //   echo $countyName.'<br/><br/>';
                          //start after the comma and select the district
                         $districtName = substr($str1, $end +1);
                         // echo $districtName.'<br/><br/>'; 
                         //build an associative array
                         $countyArray[$i] = rtrim($str1);
                        // $countyArray[$countyName] = $districtName;

                         $i++;



                          /*foreach ($counties as $c) 
                         {
                            if(strcasecmp($c->countyName, $countyName))
                             {
                           
                            //loop through the counties and add the districts
                               echo $c->countyName.' '.$districtName.'<br/><br/>';

                                        $c = District::create(
                                        [
                                            'counties_id'=>, 

                                             'districtName'=>
                                       ]
                                     );


                             }*/
                           }
                    fclose($file);
                  //  dd($countyArray);
    //    var_dump($countyArray); 
  //      echo '<br/><br/><br/><br/>';
//        var_dump($allcounties);


                    //note that $allcounties array is not zero based so we have to eadd 1
                    //because its counting up to 1 less than the total
                    //number of elements in the array
        for ($i=1; $i <count($allcounties) + 1; $i++) { 
            # code...
            echo '<b>County '.$allcounties[$i].'<br/><br/></b>';
            for ($j=0; $j <count($countyArray) ; $j++) 
            { 
                # code...
                $str1 = $countyArray[$j];

                 $end = strpos($str1,",",0);
                        
                       /* echo 'string position '.$end.'<br/>';*/
                       //echo $str1.'<br/>';

                        //extraxt the county name, it comes before the comma
                         $countyName = substr($str1, 0, $end);
                       //  echo '<h2>'.$countyName.' from file '.'</h2><br/>';
                         //$countyName = $str1;
                      //   echo $countyName.'<br/><br/>';
                          //start after the comma and select the district
                         $districtName = substr($str1, $end +1);


                        if(!strcasecmp($allcounties[$i], $countyName))
                             {
                           
                            //loop through the counties and add the districts
                               echo 'Id : '.$i.'  '.$allcounties[$i].' '.$districtName.'<br/><br/>'; //$countyName

                                     /*************************************************************/   
                                     $c = District::create(
                                        [
                                            'county_id'=>$i, 
                                            'districtName'=>$districtName
                                       ]
                                     );
                                     /***************************************************************/

                             }

               }


            }
             
            return 'Input successful';
                  
    }


    public function getDistricts($id)
    {
        $county = County::find($id);
        //dd($county);
        $districts = $county->districts;
        $i = 0;
      // dd($districts[0]->districtName);

       foreach ($districts as $d) {
           # code...
         $districtArray[$i++] = $d->districtName;
       }
       


        echo json_encode($districts);//Array

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
}
