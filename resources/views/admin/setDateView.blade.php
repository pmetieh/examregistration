@extends('layouts.adminmaster', array('pageTitle' => ' Add Testing Center '))

@section('content')
<div id="main" class="row">
    <form class="form form-horizontal" id="managerole" method="post" action="setExamDate">
        {{csrf_field()}}
        <h1>Set The Entrance Exam Date</h1>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="examDate" >Date</label>
            </div>
            <div class=" col-lg-6">
                <input class="form-control col-lg-6" type="date" id="examDate" name="examDate"/>
            </div>
        </div>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="capacity" >Time</label>       
            </div>
            <div class="col-lg-6">
                <input class="form-control col-lg-6" type="time" id="examTime" name="examTime"/>
              </div>
            </div>

            
        <div class="col-lg-6">
            <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Set Date</button>
        </div>
        <div class="col-lg-6">
            <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
        </div>
    </form>
</div>

@endsection