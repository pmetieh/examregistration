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
    $con = new Connection();
    $majorId = $_POST['majorId'];
    $qryDelete = 'delete from major where majorId='.$majorId;
    alert('Delete query '.$qryDelete);

    $stmt = $con->mysql->query($qryDelete);

    var_dump($stmt);

    if($stmt->num_rows == 1)
    {
        alert('Deleted major with ID '.$majorId);
    }else{
        alert('Delete failed .. try again '.$con->mysql->error);
    }



}



?>

<div id="outer_content" class="container">
    <div class="page-header" style="height: 50px;">
        <div id="left" style="float: left; margin-right: 30px;">
            <b style="font-size: 1.25em">Delete Course Major Form</b>
        </div>
    </div>



    <div class="rows">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" >
            <form class="form-horizontal" role="form" name="addMajor" id="addMajor" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="majorName" class="control-label col-lg-6">Major Id</label>
                    <div class="col-lg-6">
                        <input type="text" name="majorId" id="majorId" placeholder="Id of Major"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-danger" role="button"  id="btnsubmit"  name="submit">
                            <span class="glyphicon glyphicon-save"></span>Delete</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-default" role="button" name="cancel">
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
