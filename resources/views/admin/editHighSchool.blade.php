@extends('layouts.adminmaster', ['pageTitle'=>'Edit High School'])
@section('content')
    <div class="row">
        <!--<div class="col-lg-3 col-lg-12 col-sm-12 col-xs-12" >-->
     <form class="form form-horizontal" role="form" name="addHighSchool" id="addHighSchool" action="{{url('updateHSch')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h1>Add High School</h1>
             <div class="form-group">
               <label for="schName" class="control-label col-lg-6">School Name</label>
                <div class="col-lg-6">
                <select name="schName" id="schName" onchange="getSchLoc()" class="form-control col-md-6">
                    <?php  
                    use App\School;

                    $schools = School::all();

                    foreach ($schools as $sch) {
                        
                        echo '<option value="'.$sch->id.'">'.$sch->schName.'</option>';
                    }
                    ?>
                 </select>
                </div>
            </div>

            <div class="form-group">
                <label for="schLocation" class="control-label col-lg-6">School Location</label>
               
                <div class="col-lg-6">
                 <input name="schLocation" type="text" class="form-control col-md-6" id="schLocation"/>
                      
                </div>
            </div>

          
            <div class="form-group">
               <div class="col-lg-6">
                <button type="submit" class="btn btn-danger" role="button"  id="btnsubmit"  name="submit">
                        <span class="glyphicon glyphicon-save">Update</span></button>
                </div>
                <div class="col-lg-6">
                    <button type="reset" class="btn btn-default" role="button" name="cancel">
                        <span class="glyphicon glyphicon-erase">Cancel</span>
                        </button>
                </div>
            </div>

        </form>
  <!--</div>-->

  <script type="text/javascript">
      $(function(){

        getSchLoc();
      })

    function getSchLoc()  
    {
        var sch = document.getElementById('schName');
         var Id = sch.value;
      //  alert('High school Id '+Id);

        $.ajax({
           url:'{{ url('getHSchLoc') }}'+ "/"+ Id,
           type:'get',
           success: function(data){
             //   alert(data); 

                document.getElementById('schLocation').value = data;
            }});
    }
  </script>
    </div>
@endsection