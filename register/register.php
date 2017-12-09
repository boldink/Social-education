<?php
    include("../DBCON/database.php");
?>
<?php
    $regfname = "";
    $regmname = "";
    $reglname = "";
    $regemail = "";
    $password = "";
    $retypedpassword = "";
    $regphone = "";
    $reggender = "";
    $regdob = "";
    $errormessage = "";
    
    if(isset($_POST["boldink-register"]))
    {
        if(isset($_POST["boldink-password_confirmation"]) && isset($_POST["boldink-password"]) && ($_POST["boldink-password_confirmation"] != $_POST["boldink-password"]))
        {
            $errormessage = $errormessage . "Passwords do not match";
            if(isset($_POST["boldink-gender"]))
            {
                $errormessage = $errormessage . "Please select gender";
            }
        }
        else if(isset($_POST["boldink-password_confirmation"]) && isset($_POST["boldink-password"]) && ($_POST["boldink-password_confirmation"] === $_POST["boldink-password"]))
        {
            $regfname = $_POST["boldink-fname"];
            if(isset($_POST["boldink-mname"]))
            {
                $regmname = $_POST["boldink-mname"];
            }
            else
            {
                $regmname = "";
            }
            $reglname = $_POST["boldink-lname"];
            $regemail = $_POST["boldink-email"];
            $password = md5($_POST["boldink-password_confirmation"]);
            if(isset($_POST["boldink-phone"]))
            {
                $regphone = $_POST["boldink-phone"];
            }
            else
            {
                $regphone = "";
            }
            if(isset($_POST["boldink-gender"]))
            {
                $reggender = $_POST["boldink-gender"];
            }
            else
            {
                $reggender = "";
            }
            $regdob = $_POST["boldink-dob"];
            $resultdata = mysqli_query($cn,"CALL RegisterUsers('$regfname','$regmname','$reglname','$regemail', '$password','$reggender','$regdob','$regphone')") or die("Query fail: " . mysqli_error($cn));
            if($resultdata)
            {
                setcookie("login_name",$regemail,time()+60*60*24*365,"/","localhost");
                setcookie("userfirstname",$regfname,time()+60*60*24*365,"/","localhost");
                header("Location:../profile.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Boldink - Register</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

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
                            <h1>Register</h1>
                            <div class="description">
                            	<p>
	                            	Create a new account in <a href="../index.php"><strong>BOLDINK</strong></a>. It's absolutely <strong>FREE !</strong>
                                    Let's begin the journey to the world of <strong>KNOWLEDGE</strong>
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Register at <a href="../index.php"><strong>BOLD</strong>INK</a></h3>
                            		<p>Enter your details below to create a new account:</p>
                                    <!--<script>
                                        alert("<?php  //if(isset($errormessage)) {  echo $errormessage ; }?>");
                                    </script>-->
                                    
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-user"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="register.php" method="post" class="login-form">
                                    <div class="form-group col-md-6">
			                    		<label class="sr-only" for="form-fname">First Name</label>
			                        	<input type="text" name="boldink-fname" data-validation="custom" data-validation-regexp="^([a-zA-Z]+)$" placeholder="First Name(required)..." data-validation-error-msg="First name must be letters only!" class="form-username form-control" id="form-fname" required>
			                        </div>
                                    <div class="form-group col-md-6">
			                    		<label class="sr-only" for="form-lname">Last Name</label>
			                        	<input type="text" name="boldink-lname" data-validation="custom" data-validation-regexp="^([a-zA-Z]+)$" placeholder="Last Name(Required)..." data-validation-error-msg="Last name must be letters only!" class="form-username form-control" id="form-lname"  required>
			                        </div>
                                    <div class="form-group col-md-12">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="boldink-email" data-validation="email" placeholder="Email ID(Required)..." class="form-username form-control" id="form-username" data-validation-error-msg="You did not enter a valid e-mail id!" required>
			                        </div>
			                        <div class="form-group col-md-6">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="boldink-password_confirmation" data-validation="length" data-validation-length="min8" placeholder="Password(Required)..." data-validation-error-msg="Password must contain 8 characters!" required class="form-password form-control" id="form-password">
			                        </div>
                                    <div class="form-group col-md-6">
			                        	<label class="sr-only" for="form-password">Re-type Password</label>
			                        	<input type="password" name="boldink-password" data-validation="confirmation" data-validation-error-msg="Passwords do not match!" placeholder="Re-type Password(Required)..." required class="form-password form-control" id="form-password" min-length="8">
			                        </div>
                                    <div class="form-group col-md-6">
			                        	<label class="sr-only" for="form-phone">Phone</label>
			                        	<input type="text" name="boldink-phone" placeholder="Mobile Number..." class="form-username form-control numbersOnly" id="form-phone">
			                        </div>
                                    <div class="form-group col-md-6">
			                        	<label class="sr-only" for="form-gender">Gender</label>
			                        	<select name="boldink-gender" placeholder="Select gender(Required)..." required class="form-username form-control" id="form-gender">
                                            <option value="">Select gender(Required)...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
			                        </div>
                                    <div class="form-group col-md-12">
			                        	<!--<label class="sr-only" for="form-dob">DOB</label>
			                        	<input type="date" name="boldink-dob" data-validation="date_checker" data-validation-require-leading-zero="false" placeholder="Date of birth(Required)..." required class="form-username form-control" id="form-dob">-->
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type='text' class="form-control" data-validation="date_checker" data-validation-require-leading-zero="false" placeholder="Date of birth(Required)..." required />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
			                        </div>
			                        <button type="submit" id ="register" name="boldink-register" class="btn btn-block" >Register - Its free!</button>
                                    <br/>

                                    
			                    </form>
                                <label  for="form-password">Existing User?</label><a href="../login/login.php">Login</a>
                                </label>
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
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
        <!--<script src = "https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js" />-->
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>
<script>
    $.formUtils.addValidator({
        name : 'date_checker',
        validatorFunction : function(value, $el, config, language, $form) {
            var from = value.split("-");
            var inputDateYear = from[2];
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            if((currentYear - inputDateYear) < 10)
            {
                return false;
            }
        },
        errorMessage : 'You must be minimum 10 years of age!',
        errorMessageKey: 'youngDateofBirth'
    });
  $.validate({
    modules : 'security,date',
    errorMessagePosition : 'top',
    scrollToTopOnError : false,
    borderColorOnError : '#FFF',
  });
</script>

    <script type="text/javascript">
         $(document).ready(function() {
            $('#datetimepicker1').datepicker({
                format: 'dd-mm-yyyy'
            });
        });
        
        $('.numbersOnly').keyup(function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });
    </script>

</html>