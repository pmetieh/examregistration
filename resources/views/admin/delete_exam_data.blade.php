<?php
/**
 * Created by PhpStorm.
 * User: ICT UL
 * Date: 8/22/2016
 * Time: 6:39 PM
 */

include_once('connect.php');
include_once('utils.php');

if(isset($_POST['submit']))
{

    alert('About to delete data for Exam no ..'.$_POST['examNo']);

    $con = new Connection();
    $qryDelte = "delete from studentbiodata where examNo=".'"'.$_POST['examNo'].'"';
    $stmt = $con->mysql->query($qryDelte);
    if(!$stmt)
    {
        alert('Delete failed ... ');

    }else
    {
        alert("Successfully deleted data with examNo ".$_POST['examNo']);
        header("location: http://localhost/testingcenterapp/inputdata.php");
    }
}
