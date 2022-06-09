<?php
include_once('header.php');
include_once('admin/utils.php');
include_once('admin/connect.php');
//$examNo = "1000";

if(isset($_GET['examNo']))
{
    //var_dump($_POST);
    $con = new Connection();
    //var_dump($con);

    $examNo = $_GET['examNo'];


    $qrySelect = 'select * from studentbiodata where examNo=' . '"' . $examNo . '"';

    $stmt = $con->mysql->query($qrySelect);
    $result = $stmt->fetch_assoc();

   // var_dump($result);
    if (!$stmt) {
        alert('An error has occured ..\n' . $con->mysql->error);
    } else {

        //$examNo = $result['examNo'];
        $firstName = $result['firstName'];
        $otherName = $result['otherName'];
        $lastName = $result['lastName'];
        $dob = $result['dob'];
        $highSchool = $result['highSchool'];
        $gender = $result['gender'];
        $location = $result['location'];
        $graduationYear = $result['graduationYear'];
        $collegeChoice = $result['college'];
        $major = $result['major'];
        $cellNumber = $result['mobileNo'];


    }
}


if(isset($_POST['submit'])) {

    $con = new Connection();


    //dec;lare variables to hold the Posted values from the form
    $examNo = $_POST['examNo'];
    $firstName = $_POST['firstName'];
    $otherName = $_POST['otherName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $highSchool = $_POST['highSchool'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $graduationYear = $_POST['graduationYear'];
    $collegeChoice = $_POST['collegeChoice'];
    $major = $_POST['major'];
    $cellNumber = $_POST['cellNumber'];
   // $graduationYear = $_POST['graduationYear'];

    //update statement
     $qryUpdate = 'update studentbiodata set firstName='.'"'.$firstName.'"'.','.'otherName='.'"'.$otherName.'"'.','.'lastName='.'"'.$lastName.'"'.','.
        'dob='.'"'.$dob.'"'.','.'gender='.'"'.$gender.'"'.','.'highSchool='.'"'.$highSchool.'"'.','.'graduationYear='.'"'.$graduationYear.'"'.','.'location='.'"'.$location.'"'.','.
        'college='.'"'.$collegeChoice.'"'.','.'major='.'"'.$major.'"'.','.'mobileNo='.'"'.$cellNumber.'"'.
        ' where examNo='.'"'.$examNo.'"';

  //  alert('Update query ... '.$qryUpdate);
    $result = $con->mysql->query($qryUpdate);

    if(!$result)
    {
        alert('Update failed ..');
    }else
    {
        alert('Update successful ..');
    }

}

?>

<div id="outer_content" class="container">

    <div class="page-header" style="height: 50px;">
        <div id="left" style="float: left; margin-right: 30px;">
            <b style="font-size: 1.25em">University Of Liberia Entrance Exam Data Edit Form</b>
        </div>
    </div>

    <!--<div class="jumbotron">



    </div>-->
    <div class="rows">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="text-align: left;">
            <form name="student_biodata_form" id="biodata" class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="examNo" class="control-label col-lg-6" >Exam Number</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" readonly="true" id="examNo" name="examNo" value="<?php echo $examNo; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-6" for="firstName">First Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-6" for="otherName">Middle Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="otherName" name="otherName" value=".<?php echo $otherName?>."/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="control-label col-lg-6">Last Name</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-6" for="dob">Date Of Birth</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="highSchool" class="control-label col-lg-6">High School Graduated From</label>
                    <div class="col-lg-6">
                        <textarea id="highSchool" class="form-control" name="highSchool" rows="3" cols="15" ><?php echo $highSchool; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="control-label col-lg-6">Gender</label>
                    <div class="col-lg-6">
                        <select name="gender" class="form-control" id="gender" >
                            <?php

                            $arr = array("male", "female");
                            for($i = 0; $i < count($arr); $i++)
                            {

                                if($gender == $arr[$i])
                                {
                                    echo '<option value='.'"'.$arr[$i].'"'.' selected>'.$arr[$i].'</option>';
                                }
                                else{
                                    echo '<option value='.'"'.$arr[$i].'"'.'>'.$arr[$i].'</option>';
                                }
                            }

                            ?>


                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-6" for="location">Location</label>
                    <div class="col-lg-6">
                        <select class="form-control" name="location" id="location" >

                            <?php

                            /*$arr = array("Montserrado", "Grand Gedeh", "Mary Land", "Grand Bassa", "Sinoe",
                            "River Gee", "Lofa","Margibi","Bong", "Nimba","Cape Mount", "Gbarpolu","Grand Kru");*/



                            $qry = 'select * from location';
                            $con = new Connection();
                            $stmt = $con->mysql->query($qry);


                            while( $result = $stmt->fetch_assoc())
                            {

                                if($location == $result['idlocation'])
                                {
                                    echo '<option value='.'"'.$result['idlocation'].'"'.' selected>'.$result['locationDescription'].'</option>';
                                }
                                else{
                                    echo '<option value='.'"'.$result['idlocation'].'"'.'>'.$result['locationDescription'].'</option>';
                                }
                            }


                            ?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="graduationYear" class="control-label col-lg-6">Year Of Graduation</label>
                    <div class="col-lg-6">
                        <input type="text" id="graduationYear" name="graduationYear" value="<?php echo $graduationYear; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="collegeChoice" class="control-label col-lg-6">Choice of College</label>
                    <div class="col-lg-6">
                        <select id="collegeChoice" name="collegeChoice" class="form-control">

                            <?php

                            $con = new Connection();
                            $qry = 'select * from colleges';

                            $stmt = $con->mysql->query($qry);
                            //$arr = $stmt->fetch_assoc();


                           // for($i = 0; $i < count($arr); $i++)
                            while($arr = $stmt->fetch_assoc())
                            {

                                $collegeId = $arr['collegeId'];
                                if($collegeChoice == $collegeId)
                                {
                                    echo '<option value='.'"'.$collegeId.'"'.' selected>'.$arr['collegeDescription'].'</option>';
                                }
                                else{
                                    echo '<option value='.'"'.$collegeId.'"'.'>'.$arr['collegeDescription'].'</option>';
                                }
                            }

                            ?>


                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="major" class="control-label col-lg-6">Major</label>
                    <div class="col-lg-6">
                        <select id="major" name="major" class="form-control">

                            <?php

                            $con = new Connection();
                            $qry = 'select * from major';


                            $stmt = $con->mysql->query($qry);


                            // for($i = 0; $i < count($arr); $i++)
                            while($result = $stmt->fetch_assoc() )
                            {

                                $majorId = $result['majorId'];
                                if($major == $majorId )
                                {
                                    echo '<option value='.'"'.$majorId.'"'.' selected>'.$result['majorDescription'].'</option>';
                                }
                                else{
                                    echo '<option value='.'"'.$majorId.'"'.'>'.$result['majorDescription'].'</option>';
                                }
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cellNumber" class="control-label col-lg-6">Emergency Cell Number</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="cellNumber" id="cellNumber" value="<?php echo $cellNumber; ?>"/>
                    </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-danger" role="button"  id="btnsubmit"  name="submit">
                            <span class="glyphicon glyphicon-save"></span>Save</button>
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

<script src="bootstrap-3.3.6/dist/js/bootstrap.js"></script>
<script src="bootstrap-3.3.6/dist/js/bootstrap.js"></script>

<script type="text/javascript" >
    $(function(){

        //$('#btnsubmit').click(function(){
          //  alert('jQuery Works');
            //  return false;
        });
    })
</script>
</body>


</html>