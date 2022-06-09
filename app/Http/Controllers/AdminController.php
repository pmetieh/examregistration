<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd('Admin Dashboad');
        //get the authenticated user

       // return view('admin.dashboard');
        $user =  \Auth::User();

       // dd($user);
        if($user == null)
            return redirect('login');
        if($user->hasRole('admin'))
        {
            return view('admin.dashboard');

        }

        elseif($user->hasRole('student'))
        {
            return 'Role student';//view('admin.dashboard');
        }
        else
        {
            return redirect('/');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
    }

    public function createroleview()
    {
        return view('admin.createrole');
    }




    public function assignroleview()
    {
        //
        return view('admin.assignrole');
    }

    public function assignrole(Request $request)
    {
        //dd($request);
        $insertid = DB::table('role_user')->insertGetId(array('role_id' =>$request->input('rolename'), 'user_id' =>$request->input('username')));
        //
        echo 'Insert id = : '.$insertid;


    }

    public function assignStudentRole($userId, $roleId)
    {
        //dd($request);
    $insertid = DB::table('role_user')->insertGetId(array('role_id'=>$roleId, 'user_id' =>$userId));
        //
        echo 'Insert id = : '.$insertid;
        return '<br> Student Role successfully assigned';


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

    public function showStudentDetail(Request $request)
    {
        //        dd($request);

        return view('edit.getStudentDetails');

    }
    public function showStudentReport(Request $request)
    {
        //        dd($request);

        return view('reports.studentDetails');

    }

    public function showTotalReport()
    {
      //  dd($_REQUEST);
       echo '<a href="index"><b>Home</b>'.'<a/>';
    }

    public function deleteroleview()
    {
        //
        return view('admin.deleterole');
    }

    public function deleterole($id)
    {
        //dd('Role Id : '.$id);
        //delete role
        Role::where('id', $id)->delete();
        return 'Role deleted ..';
    }

    public function createrole(Request $request)
    {
       // dd($request);

        $role = Role::create(['name'=>$request->input('rolename'), 'description'=>$request->input('roledescription')]);
        return 'Role '.$request->input('rolename').' successfully created';
       // dd($role);
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
