@extends('layouts.master_payment', ['pageTitle'=>'UL Testing Center'])
@section('content')
<style type="text/css">
	li{
		list-style: none;
	}
	p
	p ul li > a{
		text-decoration: none;
	}

	div#ga{
		text-align: left;
	}
</style>
<div style="text-align: center;">
<p>
	<img class="center-block" src="images/students_taking_exam.jpg" width="100%" height="auto"/>
	<div class="row">
		<div class="jumbotron" width="%100">
			<p >
				<h2>Welcome to the University of Liberia Center for Testing and Evaluation</h2>
				<p style="text-align: left">
					In order to register for the Entrance exams, graduate and undergraduate, you
					must fill out one of the electronic registration forms on this site.
				</p>
			</p>
			</p>
		</div>
	</div>

	<div class="row">
	<div width="100%" class="col-lg-6 pull-left jumbotron">

		<p>

			<h2>Exam Date and Time</h2>
			<p>

				<?php
				use \App\ExamDate;
				use \App\Http\Controllers\ExamDateController;
				use \Illuminate\Support\Facades\DB;

				//get the most current exam date. This will correspond with the record with the highest id column value
				 $examDetail = ExamDate::find(ExamDate::max('id'));
				// echo $examDetail;
				?>
				<h5 style="color:red;"><b>Exam Date : {{$examDetail->examDate}}</b></h5>
				<h5 style="color:blue;"><b>Exam Time : {{$examDetail->examTime}}</b></h5>

			</p>
		</p>
	</div>
	<div id="ga" style="padding-left:7px;" width="100%" class="col-lg-6 pull-right jumbotron">
		<p>
			<h2>General Announcements</h2>
			<p>
				<ul>
					<li><a>Exam is comming out soon</a></li>
					<!--<li><a>Check out old results</a></li>-->
					<li><a>Past Papers</a></li>
				</ul>
			</p>
		</p>
	</div>
</div>
</p>
</div>
@endsection
