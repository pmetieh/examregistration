@extends('layouts.adminmaster', array('pageTitle' => 'Manage Roles'))

@section('content')
<div id="main" class="row">
    <form class="form form-horizontal" id="managerole" method="post" action="createrole">
        {{csrf_field()}}
        <h1>Add New Role</h1>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="rolename" >Role Name</label>
            </div>
            <div class=" col-lg-6">
                <input class="form-control col-lg-6" type="text" id="rolename" name="rolename"/>
            </div>
        </div>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="roledescription" >Role Description</label>
            </div>
            <div class="col-lg-6">
            <input class="form-control col-lg-6" type="text" id="roledescription" name="roledescription"/>
              </div>
            </div>
            
        <div class="col-lg-6">
            <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Add Role</button>
        </div>
        <div class="col-lg-6">
        <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
        </div>
    </form>
</div>

@endsection