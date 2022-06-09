@extends('layouts.adminmaster', array('pageTitle' => ' Add Testing Center '))

@section('content')
<div id="main" class="row">
    <form class="form form-horizontal" id="managerole" method="post" action="addcenter">
        {{csrf_field()}}
        <h1>Add New Testing Center</h1>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="centername" >Center Name</label>
            </div>
            <div class=" col-lg-6">
                <input class="form-control col-lg-6" type="text" id="centername" name="centername"/>
            </div>
        </div>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="capacity" >Capacity</label>
            </div>
            <div class="col-lg-6">
                <input class="form-control col-lg-6" type="text" id="capacity" name="capacity"/>
              </div>
            </div>

            <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="location" >Location</label>
            </div>
            <div class="col-lg-6">
                <input class="form-control col-lg-6" type="text" id="location" name="location"/>
              </div>
            </div>
        <div class="col-lg-6">
            <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Add Center</button>
        </div>
        <div class="col-lg-6">
            <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
        </div>
    </form>
</div>

@endsection