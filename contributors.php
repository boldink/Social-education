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
    include('newheader.php');
    include("DBCON/database.php");
   ?>
   <div class="container">
   <section>

        <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Our Contributors
                    <small>Lorem Ipsum dolor sit amet!</small>
                </h1>
                <p>Meet them who tirelessly spent their time contributing for the various materials for Boldink.</p>
            </div>
        </div>

        <!-- Team Members Row -->
        <div class="row">
            <?php
                $resultcontributors = mysqli_query($cn,"CALL GetAllContributors") or die("Query fail: " . mysqli_error());
                while ($rowcontributors = $resultcontributors->fetch_assoc())
                {
                    echo "<div class=\"col-lg-4 col-sm-6 text-center\">";
                    echo "<img class=\"img-circle img-responsive img-center\" src=\"http://placehold.it/200x200\" alt=\"\">";
                    echo "<h3>". $rowcontributors['contname']."<small>".$rowcontributors['responsibility']."</small></h3>";
                    echo "<p>".$rowcontributors['description']."</p>";
                    echo "</div>";
                }
                mysqli_close($cn);
            ?>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Dadu Babu
                    <small>Job Title</small>
                </h3>
                <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Horse
                    <small>Job Title</small>
                </h3>
                <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Dino
                    <small>Job Title</small>
                </h3>
                <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Rhino
                    <small>Job Title</small>
                </h3>
                <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>Ponchu Babu
                    <small>Job Title</small>
                </h3>
                <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                <h3>John Smith
                    <small>Job Title</small>
                </h3>
                <p>What does this team member to? Keep it short! This is also a great spot for social links!</p>
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/scrolls.js"></script>
    

</body>

</html>
