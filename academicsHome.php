<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="cache-control" content="no-store" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="-1" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boldink - Where everything ends, knowledge begins</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/Styles.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
    <!-- Page Content -->
    
   <?php 
    require('newheader.php');
    include("DBCON/database.php");
   ?>
  
    <div class="hidden-clearfix">
    </div>


    <div class="container">
        <section>
<!-- Page Header -->
<section id="academics">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Academics
                    <small>Build your career through this section...</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <?php
                 $resultdata = mysqli_query($cn,"CALL GetAllAcademicCourses") or die("Query fail: " . mysqli_error());
                 $count=1;
                 while (($rowdata = $resultdata->fetch_assoc())&& $count<=3 )
                {
                    echo "<div class=\"col-md-4 portfolio-item\">";
                    echo "<a href=\"courseHome.php?id=". $rowdata['cid'] ."\">";
                    echo "<img class=\"img-responsive faded\" src=\"data:image/jpeg;base64,".base64_encode( $rowdata['cimg'] )."\"/></a>";
                    echo "<h3><a href=\"courseHome.php?id=". $rowdata['cid']."\">". $rowdata['title'] ."</a></h3>";
                    echo "<p>". $rowdata['description'] = (strlen($rowdata['description']) > 122) ? substr($rowdata['description'],0,119).'...' : $rowdata['description'];
                    echo "</p></div>";
                    $count++;
                }
            ?>
            
            
            <div class="col-md-4 portfolio-item">
                <a ui-sref="courseDetails">
                    <img class="img-responsive" src="images/leaf.jpg" alt="">
                </a>
                <h3>
                    <a ui-sref="courseDetails">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
            
        </div>
        
</section>
</section>
<?php 
    include('footer.php');
?>
</div>

    <!-- jQuery -->
    <!--<script src="js/jquery.js"></script>-->
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="js/jquery-1.12.4.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
    <script src="js/jquery.easing.min.js"></script>
    <!-- Theme JavaScript -->
    <script src="js/scrolls.js"></script>
    

</body>

</html>