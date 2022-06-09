	<?php
		/*include("lib/inc/chartphp_dist.php");
		$p = new chartphp();

		//var_dump($p);

		// set few params
		$p->data =array(array(3,7,9,1,4,6,8,2,5),array(5,3,8,2,6,2,9,2,6));
		$p->chart_type = "line";
		$p->title = "Student Enrollment By High School";
		$p->xlabel = "High School";
		$p->ylabel = "Enrolled Students";
		// render chart and get html/js output
		$out = $p->render('c1');
*/
		?>
@extends('layouts.adminmaster', ['pageTitle' => 'Admin Dashboard'])

@section('content')
<div class="row">
   <!--  <div class="col-lg-4" style="text-align:center">
        {{--<a href="{{url('manageroles')}}">Manage Roles</a>--}}
        {{-- <img src="images/appmanagementimage.jpg"   width="700px" class="img-fluid img-responsive rounded mx-auto d-block float-right"/> --}}
         <h1>Admin Dashbord</h1>
         <h2>Reports</h2>

    </div>
    <div class="row"> -->
    	<div width="300" height="300" class="col-lg-5 pull-left">
			<?php /*echo $out*/;?>
			<a href="signin" class="btn btn-primary btn-large">Click here to sign in</a>
		</div>

		<div width="300" height="300" class="col-lg-5 pull-right">
			<?php /*echo $out*/;?>
		</div>
    <!-- </div> -->
    
</div>


@endsection