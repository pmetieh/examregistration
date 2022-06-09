<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BioDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.inputdata', ['formtype'=>'undergrad']);
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

        dd($request);

        $user = User::create(
                   [

                    'name'=>$request->input(''),
                    'email'=>$request->input(''),
                    'password'=>$request->input(''),
                    'examNo'=>$request->input(''),
                    'firstName'=>$request->input(''),
                    'otherName'=>$request->input(''),
                    'lastName'=>$request->input(''),
                    'dob'=>$request->input(''),
                    'highSchool'=>$request->input(''),
                    'graduationYear'=>$request->input(''),
                    'gender'=>$request->input(''),
                    'location'=>$request->input(''),
                    'college'=>$request->input(''),
                    'major'=>$request->input(''),
                    'mobileNo'=>$request->input(''),
                    'emergencyNo1'=>$request->input(''),
                    'emergencyNo2'=>$request->input(''),
                    'maritalStatus'=>$request->input(''),
                    'county'=>$request->input(''),
                    'district'=>$request->input(''),
                    'nationality'=>$request->input(''),
                    'collegeChoice'=>$request->input(''),
                    'schCategory'=>$request->input(''),
                    'numAttempts'=>$request->input(''),
                    'eduLevel'=>$request->input('')
                ]

        );
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
