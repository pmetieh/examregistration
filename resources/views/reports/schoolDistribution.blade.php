@extends('layouts.master', ['pageTitle'=>'Distribution Of Schools']);
@section('content')

<?php
include("lib/inc/chartphp_dist.php");
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

?>

<div width="300" height="300">
	<?php echo $out;?>
</div>
@endsection