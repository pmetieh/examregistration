@extends('layouts.master', ['pageTitle'=>'Input Data'])
@section('content')
<h1>Contact Us Template</h1>
<div class="container">
	
	<form name="contactform" class="form form-horizontal" id="contact-form" action="" method="post" enctype="multipart/form-data">
	<div class="row col-lg-12">
		<div class="form-group">
			<label class="control-label col-lg-6" for="fname">First Name</label>
			<div class="col-lg-6">
	 		<input type="text" class="form-control" name="fname" id="fname" placeholder="First Name"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-6" for="lname">Last Name</label>
			<div class="col-lg-6">
	 		<input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-6" for="email">Email Address</label>
			<div class="col-lg-6">
	 		<input type="text" class="form-control" name="email" id="email" placeholder="Email Address"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-6" for="fname">Message</label>
			<div class="col-lg-6">
	 		<textarea class="form-control" name="msg" id="msg">
	 			
	 		</textarea> 
			</div>
		</div>
	</div>
	<div id="row2" class="row col-lg-12">
		<div class="form-group">
		 <div class="col-lg-6">
         <button class="btn-lg btn-primary" type="submit" name="submit" id="submit">Assign Role</button>
        </div>
        <div class="col-lg-6">
        <button class="btn-lg btn-danger pull-right" type="reset" name="reset" id="reset">Cancel</button>
        </div>			
		</div>
	</div>
 </form>	

	
</div>	
@endsection
