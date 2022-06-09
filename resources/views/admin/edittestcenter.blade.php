@extends('layouts.adminmaster', array('pageTitle' => ' Edit Testing Center '))

@section('content')
<div id="main" class="row">
    <form class="form form-horizontal" id="tcupdatform" method="post" action="updatetc">
        {{csrf_field()}}
        <h1>Edit Existing Testing Center</h1>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="center_name" >Center Name</label>
            </div>
            <div class=" col-lg-6">
                {{-- <input class="form-control col-lg-6" type="text" id="centername" name="centername"/> --}}
                <select class="form-control col-lg-6" onchange="getTcDetails()" type="text" id="centername" name="centername">
                    <?php

                        use App\TestingCenter;
                        $tcs = TestingCenter::all();

                        foreach ($tcs as $tc) 
                        {
                           echo '<option value="'.$tc->id.'">'.$tc->centerName.'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class=" col-lg-6">
                <label class="control-label" for="_capacity" >Capacity</label>
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
            <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Update Center</button>
        </div>
        <div class="col-lg-6">
            <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
        </div>
    </form>
    <script type="text/javascript">
        $(function(){
            getTcDetails();
        })

        function getTcDetails()
        {
            var tcId = document.getElementById('centername').value;
            //alert('Testing Center Id : '+tcId);

             $.ajax({

                url:"{{ url('tcDetails') }}"+ "/"+tcId,
                type:"get",
                success: function(data){

                       // parse the jason string and convert it to a javascript
                       //alert(data);
                        var arr = JSON.parse(data);
                        //alert(arr.capacity);
                        // $('#capacity').value(arr.capacity);
                        document.getElementById('capacity').value = arr.capacity;
                        document.getElementById('location').value = arr.tcLocation;
                    //
                    // alert(typeof(arr));
                    //  alert(arr.length);
                    //loop through the array
                    //clear the contents of the prvious data appended to the <select> element
                    /*  $('#locDistrict').html("");

                    for(var i =0; i < arr.length; i++)
                    {
                          //  alert(arr[i].districtName);
                        $('#locDistrict').append('<option value="'+arr[i].id+'">'+ arr[i].districtName+'</option>');
                    }
*/

                        
                    }
                       
                }
            );
        }
    </script>
</div>

@endsection