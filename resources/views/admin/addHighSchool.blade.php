@extends('layouts.adminmaster', ['pageTitle'=>'Add High School'])
@section('content')
    <div class="row">
        <!--<div class="col-lg-3 col-lg-12 col-sm-12 col-xs-12" >-->
     <form class="form form-horizontal" role="form" name="addHighSchool" id="addHighSchool" action="{{url('addHSch')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h1>Add High School</h1>
             <div class="form-group">
                    <label for="schName" class="control-label col-lg-6">School Name</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control col-lg-6" name="schName" id="schName" class="form-control" placeholder="School Name"/>
                </div>
            </div>

            <div class="form-group">
                <label for="majorName" class="control-label col-lg-6">School Location</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control col-lg-6" value="N\A" name="schLocation" id="schLocation" placeholder="School Location"/>
                </div>
            </div>

          
            <div class="form-group">
               <div class="col-lg-6">
                <button type="submit" class="btn btn-danger" role="button"  id="btnsubmit"  name="submit">
                        <span class="glyphicon glyphicon-save">Save</span></button>
                </div>
                <div class="col-lg-6">
                    <button type="reset" class="btn btn-default" role="button" name="cancel">
                        <span class="glyphicon glyphicon-erase">Cancel</span>
                        </button>
                </div>
            </div>

        </form>
  <!--</div>-->
    </div>
@endsection