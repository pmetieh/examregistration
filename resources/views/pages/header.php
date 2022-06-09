<!DOCTYPE html>
<html>
<head>
    <title>UL Entrance Exam Database</title>
    <link href="/public/css/bootstrap-3.3.6/css/bootstrap-3.3.6.css" rel="stylesheet">
    <script src="public/js/jquery-1.11.0.js"></script>
    <script src="http://localhost/testingcenterapp/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <style>
        pcm{
            background-color: red;
            height: 20px;
            width: 200px;
            display: block;
        }
        body{

            margin-left: auto;
            margin-right: auto;



        }
    </style>

</head>
<body>
<!--<pcm>CustomTag</pcm>-->
<nav class = "navbar navbar-default" role = "navigation">

    <div class = "navbar-header">
        <a class = "navbar-brand" href = "http://localhost/testingcenterapp/index.php">Testing Center App</a>
    </div>

    <div>
        <ul class = "nav navbar-nav">
            <!--<li class = "active"><a href = "#">iOS</a></li>
            <li><a href = "#">SVN</a></li>-->

            <li class = "dropdown">
                <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">
                    Entrance Exam Data
                    <b class = "caret"></b>
                </a>

                <ul class = "dropdown-menu">
                    <li><a href = "http://localhost/testingcenterapp/inputdata.php">Input Data</a></li>
                    <li><a href = "http://localhost/testingcenterapp/getExamNo.php">Edit Data</a></li>
                    <li><a href = "http://localhost/testingcenterapp/deletdata.php">Delete Data</a></li>
                    <!--<li><a href = "#">Jasper Report</a></li>-->

                    <li class = "divider"></li>
                    <!--<li><a href = "#">Separated link</a></li>-->

                    <li><a href = "#">Reports</a></li>
                </ul>

            </li>
            <li class = "dropdown">
                <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">
                    Admin Section
                    <b class = "caret"></b>
                </a>

                <ul class = "dropdown-menu">
                    <li><a href = "http://localhost/testingcenterapp/admin/addmajor.php">Add Major</a></li>
                    <li><a href = "http://localhost/testingcenterapp/admin/editmajor.php">Edit Major</a></li>
                    <li><a href = "http://localhost/testingcenterapp/admin/deletemajor.php">Delete Major</a></li>
                    <!--<li><a href = "#">Jasper Report</a></li>-->

                    <li class = "divider"></li>
                    <li><a href="http://localhost/testingcenterapp/admin/exporttoexcel.php">Export To Excel</a></li>
                </ul>
            </li>
            <li><a href="http://localhost/testingcenterapp/admin/find.php" >Find</a></li>

        </ul>
    </div>
    <span style="display: inline"><img src="http://localhost/testingcenterapp/images/ul_logo.png" id="logo" class="img-responsive" height="50px" width="75px"/></span>
</nav>


