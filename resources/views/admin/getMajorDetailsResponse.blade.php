<?php
/**
 * Created by PhpStorm.
 * User: ICT UL
 * Date: 8/23/2016
 * Time: 11:46 AM
 */
include_once('connect.php');

if(isset($_GET['majorId']))
{
    $con = new Connection();
    $qry = 'select * from major where majorId='.$_GET['majorId'];
   // echo $qry;
    $stmt = $con->mysql->query($qry);
    $result = $stmt->fetch_assoc();
   // echo 'Major Id '.$_GET['majorId'];
    //var_dump($_GET);
    echo json_encode($result);//$qry
}