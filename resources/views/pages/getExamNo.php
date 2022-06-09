<?php
include_once('header.php');

?>
<div id="outer_content" class="container">

    <div class="page-header" style="height: 50px;">
        <div id="left" style="float: left; margin-right: 30px;">
            <b style="font-size: 1.25em">Get Exam Number</b>
        </div>
    </div>

    <!--<div class="jumbotron">



    </div>-->
    <div class="rows">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <form name="student_biodata_form" id="biodata" class="form-horizontal" action="editdata.php" method="get" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="examNo" class="control-label col-lg-6">Exam Number</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" placeholder="Enter exam number" id="examNo" name="examNo"/>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-danger" role="button"  id="btnsubmit"  name="submit">
                            <span class="glyphicon glyphicon-save"></span>Send</button>
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

<script src="bootstrap-3.3.6/dist/js/bootstrap.js"></script>
<script src="bootstrap-3.3.6/dist/js/bootstrap.js"></script>

<script type="text/javascript" >
    $(function(){

        $('#btnsubmit').click(function(){
            //alert('jQuery Works');
            //  return false;
        })
    })
</script>

</body>
</html>