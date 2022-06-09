<?php
/**
 * Created by PhpStorm.
 * User: ICT UL
 * Date: 8/20/2016
 * Time: 10:29 AM
 */

include_once('header.php');
include_once('admin/utils.php');
include_once('admin/connect.php');

if(isset($_GET['majorId']))
{
    echo 'Exam no received from ajax '.$_GET['majorId'];
}


if(isset($_POST['submit']))
{
    $majorId = $_POST['majorId'];
    $majorName = $_POST['majorName'];
    $collegeId = $_POST['collegeId'];

    var_dump($_POST);

    $con = new Connection();
    $qryUpdate = 'update  major set majorDescription='.'"'.$majorName.'"'.','.'collegeId='.$collegeId.
        ' where majorId='.$majorId;

    // alert("Update statement ".$qryUpdate);
    $stmt = $con->mysql->query($qryUpdate);

    if($stmt)
    {
        alert('Update successful ... ');

    }else{

        alert('Update failed ... '.$con->mysql->error);
    }



}

?>

<div id="outer_content" class="container">
    <div class="page-header" style="height: 50px;">
        <div id="left" style="float: left; margin-right: 30px;">
            <b style="font-size: 1.25em">Course Major Data Edit Form</b>
        </div>
    </div>



    <div class="rows">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" >
            <form class="form-horizontal" role="form" name="addMajor" id="addMajor" action="phptoexcel.php" method="post" enctype="multipart/form-data">
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
<script src="http://localhost/testingcenterapp/bootstrap-3.3.6/dist/js/bootstrap.js"></script>
<script src="http://localhost/testingcenterapp/bootstrap-3.3.6/dist/js/bootstrap.js"></script>
<!--<script src="http://localhost/testingcenterapp/js/jquery-1.11.0.js" type="text/javascript"></script>-->
<script type="text/javascript">
    $(function(){
        // alert("Exam no.");

       /* $('#majorId').change(function(){
            var _majorId = $('input#majorId').val();
            // alert('majorId..' + _majorId);
            //get the details of the major with Id _majorId
            getMajorDetails(_majorId);
        });*/

    });

    function getMajorDetails(_majorId){

        $.ajax(
            {
                //this.href
                url: 'getMajorDetailsResponse.php',
                data: {majorId: _majorId},
                dataType: "json",
                success: function(data, status){
                    //   alert("Data: " + data.majorDescription + "\n" + data.collegeId + "\nStatus: " + status);
                    $('#majorName').val(data.majorDescription);
                    $('#collegeId').val(data.collegeId);
                    $('#majorId').attr("readonly", true);

                },
                type: "GET"

            });
        /* $.get(this.href, { examNo:"1000" }, function(data, status){
         alert("Data: " + data + "\nStatus: " + status);
         });*/

    }
</script>
</body>
</html>
