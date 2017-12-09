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

    <!-- Custom CSS , also parallax effect-->
    <link href="css/Styles.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
    <!-- Page Content -->
    
   <?php 
   session_start();
    require('newheader.php');
    
    $_SESSION["pagename"] = "../index.php";
    include("DBCON/database.php");
   ?>
  
    <!--<div class="hidden-clearfix">
    </div>-->

 <!-- Parallax effect -->
        <div id="background">
            <div class="caption" style="left:90px;top:100px;">
                <span class="border">Learn, Connect and Share</span>
                <div class="sm-border">Boldink lets you achieve your dreams while learning through a community-based environment.</div>
                <ul class="ul-custom">
                    <?php 
                        if(isset($_COOKIE["login_name"]))
                        {
                    ?>
                    <li class="li-custom">
                        <button type="button" onclick="location.href='login/logout.php'" class="btn btn-outline-default btn-circle btn-xl"><i class="glyphicon glyphicon-log-out"></i></button>
                        <div class="login-custom">Logout</div>
                    </li>       
                    <?php    
                        }
                        else
                        {
                    ?>
                    <li class="li-custom">
                        <button type="button" onclick="location.href='login/login.php'" class="btn btn-outline-default btn-circle btn-xl"><i class="glyphicon glyphicon-log-in"></i></button>
                        <div class="login-custom">Login</div>
                    </li>
                    <li class="li-custom">
                        <button type="button" onclick="location.href='register/register.php'" class="btn btn-outline-default btn-circle btn-xl"><i class="glyphicon glyphicon-user"></i></button>
                        <div class="login-custom">Register</div>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <script type="text/javascript"> 
                var images = ['photo1.jpeg', 'photo2.jpeg', 'photo3.jpeg'];
                $('#background').css({'background-image': 'url(images/' + images[Math.floor(Math.random() * images.length)] + ')'});
                $('#background').css({'min-height': '450px'});
                $('#background').css({'background-attachment': 'fixed'});
                $('#background').css({'background-position': 'center'});
                $('#background').css({'background-repeat': 'no-repeat'});
                $('#background').css({'background-size': 'cover'});
                $('#background').css({'padding-left': '10px'});
                $('#background').css({'padding-top': '0px'});
            </script>
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
                 $resultdata = mysqli_query($cn,"CALL GetAllCourses") or die("Query fail: " . mysqli_error($cn));
                 $countac=1;
                 $countit=1;
                 $rowdata=mysqli_fetch_all($resultdata,MYSQLI_ASSOC); 
                 for($eachRow = 0; $eachRow < count($rowdata); $eachRow++)
                 {
                    if($rowdata[$eachRow]['belongsto'] === "ac" && $countac <= 3)
                    {
                        $rawurl = "id=". $rowdata[$eachRow]['cid'] ."&topic=Introduction";
                        $url = urlencode(base64_encode($rawurl));
                        echo "<div class=\"col-md-4 portfolio-item\">";
                        echo "<a href=\"courseHome.php?id=". urlencode(base64_encode($rowdata[$eachRow]['cid'])) ."&topic=". urlencode(base64_encode("Introduction")) ."\">";
                        echo "<img class=\"img-responsive\" src=\"". $rowdata[$eachRow]['cimg'] ."\"/></a>";
                        echo "<h3><a href=\"viewCourse.php?id=". urlencode(base64_encode($rowdata[$eachRow]['cid'])) ."&topic=". urlencode(base64_encode("Introduction")) ."\">". $rowdata[$eachRow]['title'] ."</a></h3>";
                        echo "<p>". $rowdata[$eachRow]['description'] = (strlen($rowdata[$eachRow]['description']) > 122) ? substr($rowdata[$eachRow]['description'],0,119).'...' : $rowdata[$eachRow]['description'];
                        echo "</p></div>";
                        $countac++;
                    }
                    else{continue;}
                 }
                
                // }
                
            ?>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="btn-show-more">
                    <a class="btn btn-default" href="#">Show More...</a>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
        <!-- /.row -->
</section>
<section id="itground">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">IT Grounds
                    <small>Learn the latest IT technologies here...</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <?php
                for($eachRow = 0; $eachRow < count($rowdata); $eachRow++)
                 {
                    if($rowdata[$eachRow]['belongsto'] === "it" && $countit <= 3)
                    {
                        $rawurl = "id=". $rowdata[$eachRow]['cid'] ."&topic=Introduction";
                        $url = urlencode(base64_encode($rawurl));
                        echo "<div class=\"col-md-4 portfolio-item\">";
                        echo "<a href=\"courseHome.php?id=". urlencode(base64_encode($rowdata[$eachRow]['cid'])) ."&topic=". urlencode(base64_encode("Introduction")) ."\">";
                        echo "<img class=\"img-responsive\" src=\"". $rowdata[$eachRow]['cimg'] ."\"/></a>";
                        echo "<h3><a href=\"viewCourse.php?id=". urlencode(base64_encode($rowdata[$eachRow]['cid'])) ."&topic=". urlencode(base64_encode("Introduction")) ."\">". $rowdata[$eachRow]['title'] ."</a></h3>";
                        echo "<p>". $rowdata[$eachRow]['description'] = (strlen($rowdata[$eachRow]['description']) > 122) ? substr($rowdata[$eachRow]['description'],0,119).'...' : $rowdata[$eachRow]['description'];
                        echo "</p></div>";
                        $countit++;
                    }
                    else{continue;}
                 }
            ?>
            
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="btn-show-more">
                    <a class="btn btn-default" href="">Show More...</a>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
        
</section>
<section id="beyondacademics">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Beyond Academics
                    <small>Explore the vast world of knowledge through this section...</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="images/messi.jpg" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="images/freedomfighters.jpg" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="images/ronaldo.jpg" alt="">
                </a>
                <h3>
                    <a href="#">Project Name</a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="btn-show-more">
                    <a class="btn btn-default" href="#">Show More...</a>
                </div>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
</section>
<?php 
    include('footer.php');
?>
    </div>
    
    <!-- /.container -->

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
