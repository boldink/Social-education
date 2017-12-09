<?php
        include("../DBCON/database.php");
        session_start();
        $email="";
        $pass="";
        $refPage = basename($_SERVER['HTTP_REFERER']);
        $errormessage=null;
        if(isset($_POST["boldink-email"]) && isset($_POST["boldink-password"]))
        {
                $email = $_POST["boldink-email"];
                $pass = md5($_POST["boldink-password"]);
        }
        $resultdata = mysqli_query($cn,"CALL UserLogin('$email', '$pass')") or die("Query fail: " . mysqli_error());
        if(count($resultdata) === 0)
        {
            echo "<script>alert(\"".count($resultdata)."\")</script>";
            echo "<script>alert(\"Wrong username or password!\")</script>";
            //$errormessage="Wrong username or password!";
        }
        else
        {
            while($rowdata = $resultdata->fetch_assoc())
            {
                setcookie("login_name",$rowdata['Email'],time()+60*60*24*365,"/","localhost"); //Replace localhost with boldink.co.in
                setcookie("userfirstname",$rowdata['F_Name'],time()+60*60*24*365,"/","localhost");
                header("Location: ".$_SESSION["pagename"]);
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Boldink - Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>
        
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Login</h1>
                            <div class="description">
                            	<p>
	                            	Login to <a href="../index.php"><strong>BOLDINK</strong></a> or create a new account. It's absolutely <strong>FREE !</strong>
                                    Let's begin the journey to the world of <strong>KNOWLEDGE</strong>
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to <a href="../index.php"><strong>BOLD</strong>INK</a></h3>
                            		<p>Enter your username and password to log on:</p>
                                    <!--<script>
                                        alert("<?php  //if(isset($errormessage)) {  echo $errormessage ; }?>");
                                    </script>-->
                                    
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="login.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="boldink-email" placeholder="Username..." class="form-username form-control" id="form-username" required>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="boldink-password" placeholder="Password..." class="form-password form-control" id="form-password" required>
			                        </div>
			                        <button type="submit" class="btn btn-block">Sign in!</button>
                                    <br/>
                                    <!--<form action="register.php">
                                        <button type="submit" class="btn register">Register - its free!</button>                                                                                                                        
                                    </form>    -->
                                    <a class="btn register" href="../register/register.php">Register - its free!</a>                                                                                                                    
                                    <a class="btn forgot" href="#">Forgot Password</a>
                                    
			                    </form>
                                
                                </label>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>