@extends('layouts.adminmaster', array('pageTitle' => 'Assign Role'))

@section('content')
<div id="main" class="row">
    <form class="form form-horizontal" id="managerole" method="post" action="assignrole">
        {{csrf_field()}}
        <h1>Assign Role</h1>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="username" >User Name</label>
            </div>
            <div class=" col-lg-6">

              <select class="form-control" name="username" id="username">
                    <?php
                    use Illuminate\Support\Facades\DB;
                      use App\User;

                    $roles = DB::table('roles')->get();
                    $users = DB::table('users')->get();
                   // $us = User::all();
                    //dd($us);

                    foreach($users as $user)
                    {
                        echo '<option value="'.$user->id.'">'.$user->name.'</p>';
                    }

                    ?>
              </select>
                <input class="form-control col-lg-6" type="hidden" id="userid" name="userid"/>
            </div>
        </div>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="rolename" >Role Name</label>
            </div>
            <div class="col-lg-6">

                <select class="form-control" name="rolename" id="rolename">
                    <?php
                    //  $roles = DB::table('roles')->get();

                    //dd($roles);
                        foreach($roles as $role)
                            {
                                echo '<option value="'.$role->id.'">'.$role->name.'</p>';
                            }
                    ?>
                </select>
                <input class="form-control col-lg-6" type="hidden" id="userid" name="userid"/>
              </div>
            </div>
        <div class="col-lg-6">
            <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Assign Role</button>
        </div>
        <div class="col-lg-6">
            <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
        </div>
    </form>
</div>

@endsection