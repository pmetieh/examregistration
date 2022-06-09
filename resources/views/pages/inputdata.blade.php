@extends('layouts.master', ['pageTitle'=>'UnderGraduate BioData Form'])
@section('content')
{{-- <div id="outer_content" class="container"> --}}

   <h1 style="font-size: 2.5em; text-align: center; color: blue;">University Of Liberia</h1>
   <h3>UnderGraduate Entrance Exam BioData Input Form</h3>



    <form  name="student_biodata_form" id="biodata" name="biodata"  role="form" action="{{ url('savedata') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="row">
        <p>
          <input type="file" onchange="previewPic()" id="photo" class="pull-left"/>
           <img class="pull-right" id="img_pic" style="margin-bottom: 10px;" src="images/no_image.jpg" alt="photo" width="100px" height="100px"/>
       </p>

      </div>
       <div class="row jumbotron">
           {{-- <div class="form-group">
                    {{-- <label class="control-label col-md-6"></label> --}}
                    {{-- <div class="col-md-6 pull-left">
                        <b>Undergraduate Program</b><input class="form-control" onchange="underGradChecked()" name="grad" id="undergrad" value="undergrad" type="radio" />
                    </div>

                    <div class="col-md-6 pull-right">
                     <b>Graduate Program</b><input class="col-md-6 form-control" onchange="gradChecked()" name="grad" id="grad" value="grad" type="radio"/>
                    </div>
                     --}}

              {{--   </div>  --}}
           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-6 control-label">Login Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-6 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                     </div>


       <div class="row jumbotron" id="row0">


                <div class="form-group">
                    <label class="control-label col-md-6" for="firstName">First Name</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name"/>
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-lg-6" for="otherName">Middle Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="otherName" name="otherName" placeholder="Middle Name" value=" "/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="control-label col-lg-6">Last Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-6" for="dob">Date Of Birth</label>
                    <div class="col-lg-6">
                        <input type="date" class="form-control" id="dob" name="dob"/>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="nationality" class="control-label col-lg-6">Nationality</label>
                    <div class="col-lg-6">
                       <select class="form-control" name="nationality" id="nationality">
                           <option value="Liberian">Liberian</option>
                           <option value="Nigerian">Nigerian</option>
                       </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="maritalStatus" class="control-label col-lg-6">Marital Status</label>
                    <div class="col-lg-6">
                       <select class="form-control" name="maritalStatus" id="maritalStatus">
                           <option value="Single">Single</option>
                           <option value="Married">Married</option>
                           <option value="Divorced">Divorced</option>
                           <option value="widowed">Widowed</option>
                       </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="countyOfO" class="control-label col-lg-6">County Of Origin</label>
                    <div class="col-lg-6">
                       <select class="form-control col-md-6" name="countyOfO" id="countyOfO">

                            <?php
                                use App\County;

                                $counties = County::all();
                                foreach ($counties as $c) {
                                    # code...
                                    echo '<option value="'.$c->id.'">'.$c->countyName.'<option/>';
                                }


                            ?>

                       </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="gender" class="control-label col-lg-6">Gender</label>
                    <div class="col-lg-6">
                        <select name="gender" class="form-control" id="gender" >
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="cellNumber" class="control-label col-lg-6">Emergency Cell Number 1</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="cellNumber1" id="cellNumber1" placeholder="Emrgency Cell Number"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cellNumber" class="control-label col-lg-6">Emergency Cell Number 2</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="cellNumber2" id="cellNumber2" placeholder="Emrgency Cell Number"/>
                    </div>
                </div>

                <div class="form-group">
                   <label class="col-md-6" for="numAttempts">Number Of Exam Attemps</label>
                   <div class="col-md-6">
                       <select class="form-control" name="numAttempts" id="numAttempts">
                          <option value="OneTime">OneTime</option>
                          <option value="TwoTimes">TwoTimes</option>
                          <option value="ThreeTimes">ThreeTimes</option>
                          <option value="FourOrMoreTimes">FourOrMoreTimes</option>
                       </select>
                   </div>

               </div>

            </div><!--row0 ends here-->


           <div class="row jumbotron" id="row1"><!--undergrad section-->
             <div class="form-group">
                    <label for="examNo" class="control-label col-md-6" >Exam Number</label>
                    <div class="col-md-6">
                         <input type="text" class="form-control col-md-6" id="examNo" name="examNo" placeholder="Exam Number"/>
                    </div>

                </div>
                 <div class="form-group">
                    <label for="examNo" class="control-label col-md-6" >Mobile Number</label>
                    <div class="col-md-6">
                         <input type="text" class="form-control col-md-6" id="mobileNo" name="mobileNo" placeholder="Mobile Number"/>
                    </div>

                </div>
               <div class="form-group">
                <h3>Under Graduate Section</h3>
                   <label class="col-md-6" for="schCategory">Category Of School</label>
                   <div class="col-md-6">
                       <select class="form-control" name="schCategory" id="schCategory">
                          <option value=Private School">Private School</option>
                          <option value="Government/Public School">Government/Public School</option>
                          <option value="Faith-Based School">Faith-Based School</option>
                          <option value="Community School">Community School</option>
                          <option value="Company School">Company School</option>
                       </select>
                   </div>

               </div>


               <div class="form-group">
                   <label class="col-md-6" for="eduLevel">Educational Level</label>
                   <div class="col-md-6">
                       <select class="form-control" name="eduLevel" id="eduLevel">
                           <option value="HighSchoolGrad">High School Grad</option>
                           <option value="StudentFromAnotherSchool">Student From Another School</option>
                           <option value="Current12Grader">Current 12 Grader</option>

                       </select>
                   </div>

               </div>


             <div class="form-group">
                    <label for="highSchool" class="control-label col-lg-6">High School Graduated From</label>
                    <div class="col-lg-6">
                       <select class="form-control col-md-6" name="highSchool" id="highSchool">
                        <?php
                                use App\School;
                                $schools = School::all();
                                foreach($schools as $s)
                                {

                                  echo '<option value="'.$s->id.'">'.$s->schName.'</option>';

                                }
                        ?>


                       </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="graduationYear" class="control-label col-lg-6">Year Of Graduation</label>
                    <div class="col-lg-6">
                        <input type="date" class="form-control col-md-6" id="graduationYear" name="graduationYear"/>
                    </div>
                </div>
                <div class="form-group">

                    <label class="control-label col-lg-6" for="county">Location - County</label>
                    <div class="col-lg-6">
                        <select class="form-control" onchange="getdistricts()" name="locCounty" id="locCounty" >
                            <?php


                               // $counties = County::all();
                                foreach ($counties as $c) {
                                    # code...
                                    echo '<option value="'.$c->id.'">'.$c->countyName.'<option/>';
                                }


                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-6" for="locDistrict">Location - District</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="locDistrict" id="locDistrict" >
                            <?php


                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="collegeChoice" class="control-label col-lg-6">Choice of College</label>
                    <div class="col-lg-6">
                        <select id="collegeChoice" name="collegeChoice" class="form-control">

                            <?php
                            use App\College;
                            $colleges = College::all();
                            foreach($colleges as $c)
                               {
                                 echo '<option value="'.$c->id.'">'.$c->collegeName.'</option>';
                               }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="major" class="control-label col-lg-6">Major</label>
                    <div class="col-lg-6">
                        <select id="major" name="major" class="form-control">
                            <?php
                             use App\Major;
                             $majors = Major::all();
                             foreach ($majors as $m) {
                               echo '<option value="'.$m->id.'">'.$m->majorName.'</option>';
                                 # code...
                             }

                            ?>
                        </select>
                    </div>
                </div>


           </div><!--undergrad section-->


           <div class="row jumbotron" id="row3"><!--official section-->
             <h2 style="color:red">Payment</h2>
              <div class="form-group">
                <label class="col-md-6 control-label" for="amntpaid">Amount Paid</label>
                <div class="col-md-6">
                    <input class="form-control col-md-6" type="text" name="amntpaid" id="amntpaid"/>
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-6 control-label" for="paydate">Payment Date</label>
                <div class="col-md-6">
                    <input class="form-control col-md-6" type="date" name="paydate" id="paydate"/>
                </div>
              </div>

               <div class="form-group">
                <label class="col-md-6 control-label" for="bankRecptNo">Bank Receipt No</label>
                <div class="col-md-6">
                    <input class="form-control col-md-6" type="text" name="bankRecptNo" id="bankRecptNo"/>
                </div>
              </div>

           </div>


           <div class="row jumbotron" id="row4">
                <div class="form-group">
                    <div class="col-lg-6">
                       <button type="submit" class="btn btn-danger pull-left" role="button"  id="btnsubmit"  name="submit">
                            <span class="glyphicon glyphicon-save"></span>Save</button>
                    </div>

                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-default pull-right" role="button" name="cancel">
                        <span class="glyphicon glyphicon-erase"></span>
                         Cancel</button>
                    </div>
                </div>


           </div>

        </form>

<!--</div>-->

<script src="bootstrap-3.3.6/dist/js/bootstrap.js"></script>
<script src="bootstrap-3.3.6/dist/js/bootstrap.js"></script>

<script type="text/javascript" >
    $(function(){

         alert('jQuery is working');
         $('#biodata').on('submit', function(e){
            e.preventDefault();

            ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data: new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){},
                success:function(data){

                }
            });
         });

          underGradChecked();
          gradChecked();

          getdistricts();
          previewPic();
        });

       function gradChecked()
       {
         if($('#grad:checked').val())
                {
                     alert('Checked...');
                     $('#row1').hide();
                     $('#row2').show();
                }

       }

       function underGradChecked()
       {
         if($('#undergrad:checked').val())
                {
                     alert('Checked...');
                     $('#row2').hide();
                     $('#row1').show();
                }

       }

        function getdistricts()
        {
            var Id = document.getElementById('locCounty').value;// $('#locCounty').value;
            //alert('County Id '+Id);

            $.ajax({

                    url:"getDistricts/"+Id,
                    type:"get",
                    success: function(data){

                           // parse the jason string and convert it to a javascript

                            var arr = JSON.parse(data);
                        //
                        // alert(typeof(arr));
                        //  alert(arr.length);
                        //loop through the array
                        //clear the contents of the prvious data appended to the <select> element
                          $('#locDistrict').html("");

                          for(var i =0; i < arr.length; i++)
                          {
                                //  alert(arr[i].districtName);
                              $('#locDistrict').append('<option value="'+arr[i].id+'">'+ arr[i].districtName+'</option>');
                          }



                        }

                    }
                );

           // console.log('Ajax couldn\'t execute');

        }

        function previewPic()
        {
         // alert('File uploaded');

           //var fileObj = File($('#photo'));
          // alert(fileObj.files[0].name);

          //get the files array from the File input element
             var oFiles = document.getElementById('photo').files;

             //get the img html dom element
                var img = document.getElementById('img_pic');//$('#img_pic');
              //  console.log(img);
              //create an image source url stream from the uploaded file object
                img.src = window.URL.createObjectURL(oFiles[0]);
               // img.height = '60';

               //load the image
                img.onload = function() {
                    window.URL.revokeObjectURL(img.src);
                };
                //alert(img.src);
            //    var fReader = new FileReader();
              //  alert(oFiles[0].name);
              //  alert('upoading file');
              //  alert(oFiles.length);
                console.log(oFiles);
        }

</script>
@endsection
