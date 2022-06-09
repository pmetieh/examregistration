<?php
/**
 * Created by PhpStorm.
 * User: ICT UL
 * Date: 8/20/2016
 * Time: 10:29 AM
 */

include_once('../header.php');
include_once('utils.php');
include_once('connect.php');

if(isset($_POST['submit']))
{
    $majorId = $_POST['majorId'];
    $majorName = $_POST['majorName'];
    $collegeId = $_POST['collegeId'];

    $con = new Connection();
    $qryInsert = 'insert into major(majorId, majorDescription, collegeId) values(?, ?, ?)';
    $stmt = $con->mysql->prepare($qryInsert);

    if(!$stmt)
    {
        alert('An error occured ..'.$con->mysql->error);
    }else{

        $stmt->bind_param("isi", $majorId, $majorName, $collegeId);
        $stmt->execute();
        if($stmt->num_rows == 1)
        {
            alert('Insert successful ..');
        }
    }



}

?>

<div id="outer_content" class="container">
    <div class="page-header" style="height: 50px;">
        <div id="left" style="float: left; margin-right: 30px;">
            <b style="font-size: 1.25em">Course Major Data Input Form</b>
        </div>
    </div>



    <div class="rows">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" >
        <form class="form-horizontal" role="form" name="addMajor" id="addMajor" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="majorId" class="control-label col-lg-6">Major Id</label>
                <div class="col-lg-6">
                    <input type="text" name="majorId" id="majorId" class="form-control"/>
                </div>
            </div>

            <div class="form-group">
                <label for="majorName" class="control-label col-lg-6">Major Name</label>
                <div class="col-lg-6">
                    <input type="text" name="majorName" id="majorName" placeholder="Description of Major"/>
                </div>
            </div>

            <div class="form-group">
                <label for="collegeId" class="control-label col-lg-6">CollegeId</label>
                <div class="col-lg-6">
                    <input type="text" name="collegeId" id="collegeId" placeholder="Associated College ID"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-danger" role="button"  id="btnsubmit"  name="submit">
                        <span class="glyphicon glyphicon-save"></span>Save</button>
                </div>
                <div class="col-lg-6">
                    <button type="reset" class="btn btn-default" role="button" name="cancelk">
                        <span class="glyphicon glyphicon-erase"></span>
                        Cancel</button>
                </div>
            </div>

        </form>
  </div>
</div>
</div>
</body>
</html>
