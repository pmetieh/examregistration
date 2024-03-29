@extends('layouts.master', ['pageTitle'=>'Graduate School Biodata Form'])
@section('content')
{{-- <div id="outer_content" class="container"> --}}

   <h1 style="font-size: 1.5em; text-align: center; color: blue;">University Of Liberia Entrance</h1>
   <h2>Graduate Entrance Exam BioData Form</h1>



    <form  name="gradstudent_biodata_form" id="gradbiodata" role="form" action="{{ url('savegraddata') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="row">
        <p>
          <input type="file" onchange="previewPic()" id="photo" class="pull-left"/>
           <img class="pull-right" id="img_pic"style="margin-bottom: 10px;" src="images/no_image.jpg" alt="photo" width="100px" height="100px"/>

        </p>

      </div>
       <div class="row jumbotron">

           <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-6 control-label">Login Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <span class="alert-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @error('email'))
                                <span class="alert-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            @error('password'))
                            <span class="alert-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-6 control-label">Confirm Password</label>

                                <div class="col-md-3">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                @error('password-confirm')
                                <span class="alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>

                     </div>


       <div class="row jumbotron">
                <div class="form-group">
                    <label class="control-label col-md-6" for="firstName">First Name</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name"/>
                      @error('firstname')
                      <span class="alert-danger">
                          {{ $message }}
                      </span>
                      @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-lg-6" for="otherName">Middle Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="otherName" name="otherName" placeholder="Middle Name"/>
                        @error('otherName')
                        <span class="alert-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="lastName" class="control-label col-lg-6">Last Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"/>
                        @error('lastName')
                        <span class="alert-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label col-lg-6" for="dob">Date Of Birth</label>
                    <div class="col-lg-6">
                        <input type="date" class="form-control" id="dob" name="dob"/>
                        @error('date')
                        <span class="alert-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>

                 <div class="form-group">
                    <label for="nationality" class="control-label col-lg-6">Nationality</label>
                    <div class="col-lg-6">
                       <select class="form-control" name="nationality" id="nationality">
                           <option value="Liberian">Liberian</option>
                           <option value="Nigerian">Nigerian</option>
                       </select>
                       @error('nationality')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
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
                       @error('maritalStatus')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="county" class="control-label col-lg-6">County Of Origin</label>
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
                   @error('countyOfO')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="gender" class="control-label col-lg-6">Gender</label>
                    <div class="col-lg-6">
                        <select name="gender" class="form-control" id="gender" >
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        @error('gender')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    </div>

                </div>


                 <div class="form-group">
                    <label for="mobileno" class="control-label col-md-6" >Mobile Number</label>
                    <div class="col-md-6">
                         <input type="text" class="form-control col-md-6" id="mobileNo" name="mobileNo" placeholder="Mobile Number"/>
                         @error('mobileno')
                         <span class="alert-danger">
                             {{ $message }}
                         </span>
                         @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="cellNumber" class="control-label col-lg-6">Emergency Cell Number 1</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="cellNumber1" id="cellNumber1" placeholder="Emrgency Cell Number"/>
                        @error('cellNumber1')
                        <span class="alert-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="cellNumber" class="control-label col-lg-6">Emergency Cell Number 2</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="cellNumber2" id="cellNumber2" placeholder="Emrgency Cell Number"/>
                        @error('cellNumber2')
                        <span class="alert-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>


            <div class="form-group">
                    <label for="examNo" class="control-label col-md-6" >Exam Number</label>
                    <div class="col-md-6">
                         <input type="text" class="form-control col-md-6" id="examNo" name="examNo" value="26374"/>
                         @error('examNo')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
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


            </div><!--row1 ends here-->

 @if ($formtype == 'grad')
            <div class="row jumbotron" id="row2" style="background-color: light blue"><!--graduate school section-->
            <h3>Graduate Section</h3>

            <div class="form-group">
                <label class="col-md-6 control-label" for="">Degree Earned</label>
              <div class="col-md-6">
                <select class="form-control" name="degreeEarned" id="degreeEarned">
                     <option value="BA">BA</option>
                     <option value="BSC">BSC</option>
                     <option value="BTech">BTech</option>
                </select>
                @error('degreeEarned')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
             </div>

            </div>

             <div class="form-group">
              <label class="col-md-6 control-label" for="gpa">GPA</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" name="gpa" id="gpa" />
                  @error('gpa')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
              </div>

             </div>

             <div class="form-group">
                    <label for="county" class="control-label col-lg-6" for="uniLoc">University Location</label>
                    <div class="col-lg-6">
                       <select class="form-control col-md-6" name="uniLoc" id="uniLoc">

                            <?php
                                //use ;

                                $countries = \App\Country::all();
                                foreach ($countries as $c) {
                                    # code...
                                    echo '<option value="'.$c->id.'">'.$c->countryName.'<option/>';
                                }


                            ?>

                       </select>
                    </div>
                    @error('uniLoc')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
             </div>
             <!--</div>-->
                <h2>Health Science</h2>

                <div class="form-group">
                    <label for="county" class="control-label col-lg-6" for="medicalSchool">Health Science Program</label>
                    <div class="col-lg-6">
                       <select class="form-control col-md-6" name="medicalSchool" id="medicalSchool">
                            <option value="AM Doglioti College Of Medicine">AM Doglioti College Of Medicine<option/>
                            <option value="School Of Pharmacy">School Of Pharmacy<option/>
                            <option value="Graduate School">Graduate School<option/>
                       </select>
                    </div>
                    @error('medicalSchool')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
             </div>
            </div>

            {{--  <div class="form-group">
              <label class="col-md-6 control-label" for="uniLoc">Country</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" name="country" id="country" />
              </div>
             </div>   --}}

           </div><!--graduate school section ends here-->
   @endif

           <div class="row jumbotron" id="row2"><!--official section-->
             <h2 style="color:red">Official Use Only</h2>
              <div class="form-group">
                <label class="col-md-6 control-label" for="amntpaid">Amount Paid</label>
                <div class="col-md-6">
                    <input class="form-control col-md-6" type="text" name="amntpaid" id="amntpaid" value="150"/>
                </div>
                @error('amntpaid')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
              </div>


              <div class="form-group">
                <label class="col-md-6 control-label" for="paydate">Payment Date</label>
                <div class="col-md-6">
                    <input class="form-control col-md-6" type="date" name="paydate" id="paydate"/>
                    @error('paydate')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

              </div>

               <div class="form-group">
                <label class="col-md-6 control-label" for="bankRecptNo">Bank Receipt No</label>
                <div class="col-md-6">
                    <input class="form-control col-md-6" type="text" name="bankRecptNo" id="bankRecptNo" value="908876541"/>
                </div>
                @error('bankRecptNo')
                    <span class="alert-danger">
                        {{ $message }}
                    </span>
                    @enderror
              </div>

           </div>

           <div class="row jumbotron" id="row3">
                <div class="form-group">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-danger pull-left" role="button"  id="btnsubmit"  name="submit">
                            <span class="glyphicon glyphicon-save"></span>Save</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-default pull-right" role="button" name="cancelk">
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


      getdistricts();
        });

    function getdistricts()
    {
        var Id = document.getElementById('locCounty').value;// $('#locCounty').value;
       // alert('County Id '+Id);

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
