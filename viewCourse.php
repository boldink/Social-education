<?php
if(isset($_COOKIE["login_name"]))
{
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
}
session_start();
?>
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
    <!-- Styele for shadow-box-->
    <style>
        div.card {
        width: 100%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;        
        }

        div.header {
            /*background-color: #4CAF50;*/
            background-color: white;
            color: black;
            padding: 10px;  
            /*font-size: 40px;*/
        }

        div.container1 {
            padding: 10px;
        }
        div.justadding{
            height:500px;
        }
    </style>
    <!-- Page Content -->
    
   <?php 
    include('newheader.php');
    include("DBCON/database.php");
   ?>
  
    <div class="hidden-clearfix">
    </div>
<!-- Modal for login check-->
<div class="modal fade" id="alertModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You need to be logged in to enroll for this course!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="ghost-btn" onclick = "window.location.href='login/login.php'">Log in</button>
        <button type="button" class="ghost-btn" onclick = "window.location.href='register/register.php'">Register</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">I don't want knowledge!</button>
      </div>
    </div>
  </div>
</div>

    <div class="container">

 <div class="row">

            <div class="col-md-3">
                <p class="lead">Topics</p>
                <div class="list-group" id="topics-list">
                    <?php 
                        $_SESSION["pagename"] = "../viewCourse.php?id=" . $_GET["id"] . "&topic=" . $_GET["topic"];
                        $courseid = urldecode(base64_decode($_GET["id"]));
                        $contentdata = mysqli_query($cn,"CALL GetAllTopicsAndContentByCID('$courseid')") or die("Query fail: " . mysqli_error());
                        $content = mysqli_fetch_all($contentdata,MYSQLI_ASSOC);
                        if(!isset($_COOKIE["login_name"]))
                        {
                            //echo "<a href=\"viewCourse.php?id=". base64_encode($content[0]['cid']) ."&topic=". base64_encode($content[0]['topicid']) ."\" class=\"list-group-item\">". $content[0]['topics'] ."</a>";
                            echo "<a class=\"list-group-item\" onclick = getContentData(0)>". $content[0]['topics'] ."</a>";
                            for($topicsIndex = 1; $topicsIndex <  count($content); $topicsIndex++)
                            {
                                echo "<a class=\"list-group-item disabled\">". $content[$topicsIndex]['topics'] ."<span style=\"float:right;\" class=\"glyphicon glyphicon-lock\"></span></a>";
                            }
                        }
                        else if($content[0]['email'] == null && isset($_COOKIE["login_name"]))
                        {
                            echo "<a class=\"list-group-item\" onclick = getContentData(0)>". $content[0]['topics'] ."</a>";
                            for($topicsIndex = 1; $topicsIndex <  count($content); $topicsIndex++)
                            {
                                echo "<a class=\"list-group-item disabled\">". $content[$topicsIndex]['topics'] ."<span style=\"float:right;\" class=\"glyphicon glyphicon-lock\"></span></a>";
                            }
                        }
                        else
                        {
                            if($content[0]['email'] == $_COOKIE["login_name"])
                            {
                                echo "<a class=\"list-group-item\" onclick = getContentData(0)>". $content[0]['topics'] ."</a>";
                                for($topicsIndex = 1; $topicsIndex <  count($content); $topicsIndex++)
                                {
                                    echo "<a class=\"list-group-item disabled\">". $content[$topicsIndex]['topics'] ."<span style=\"float:right;\" class=\"glyphicon glyphicon-lock\"></span></a>";
                                }
                            }
                            else
                            {
                                echo "<a class=\"list-group-item\" onclick = getContentData(0)>". $content[0]['topics'] ."</a>";
                                for($topicsIndex = 1; $topicsIndex <  count($content); $topicsIndex++)
                                {
                                    echo "<a class=\"list-group-item disabled\">". $content[$topicsIndex]['topics'] ."<span style=\"float:right;\" class=\"glyphicon glyphicon-lock\"></span></a>";
                                }
                            }
                        }
                        
                    ?>
                </div>
            </div>

            <div class="col-md-9">

            <!-- Div Container with carousel-->
                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
            <!-- Div Container with carousel-->

               <!-- Div Container to be shadow-boxed-->
                <div class="row">
                    <!-- Adding code here -->
                    <div class="container1">
                        <div class="card">
                            <div class="header" id="contents">
                               
                                <!-- Div content goes here-->
                            </div><!--header section -->
                            <?php 
                                if(isset($_COOKIE["login_name"]))
                                {
                                    $isLoggedIn = 1;
                                }
                                else{$isLoggedIn = 0;}
                             ?>
                             <script type="text/javascript">
                                    var content = <?php echo json_encode($content); ?> ;
                                    var loggedInUser = "<?php echo $_COOKIE["login_name"]; ?>";
                                    var loggedin = <?php echo $isLoggedIn; ?>;
                                    $(document).ready(function(){
                                        for(var i = 0; i<content.length; i++)
                                        { 
                                            if(content[i].email == null || loggedin == 0){
                                                $("#contents").html("<div><p style='float:right; width:100%; text-align:right;'><button type=\"button\" class=\"ghost-btn\" onclick='enroll()'>Enroll Now</button></p></div>"
                                                + "<div><p><h4 style='text-align:left;'>" + content[0].topics + "</h4></p></div>"
                                                + "<div style='text-align:left;'>" + content[0].content + "</div>");
                                            }
                                            else if(content[i].email == null && loggedin == 0)
                                            {
                                                $("#contents").html("<div><p style='float:right; width:100%; text-align:right;'><button type=\"button\" class=\"ghost-btn\" onclick='enroll()'>Enroll Now</button></p></div>"
                                                + "<div><p><h4 style='text-align:left;'>" + content[0].topics + "</h4></p></div>"
                                                + "<div style='text-align:left;'>" + content[0].content + "</div>");
                                            }
                                            else if(content[i].email != loggedInUser && loggedin == 1)
                                            {
                                                $("#contents").html("<div><p style='float:right; width:100%; text-align:right;'><button type=\"button\" class=\"ghost-btn\" onclick='enroll()'>Enroll Now</button></p></div>"
                                                + "<div><p><h4 style='text-align:left;'>" + content[0].topics + "</h4></p></div>"
                                                + "<div style='text-align:left;'>" + content[0].content + "</div>");
                                            }
                                            else
                                            {
                                                var htmltext = "";
                                                $("#contents").html("<div><p><h4 style='text-align:left;'>" + content[0].topics + "</h4></p></div>"
                                                + "<div style='text-align:left;'>" + content[0].content + "</div>");
                                                for(var i = 0; i < content.length; i++)
                                                {
                                                    var htmltext = htmltext + "<a class=\"list-group-item\" onclick = getContentData("+ content[i].topicid +")>"+ content[i].topics +"</a>";
                                                }
                                                $("#topics-list").html(htmltext);
                                            }
                                        }
                                            
                                        });
                                       
                                    function getContentData(topicindex)
                                    {
                                        for(var i =0; i<content.length; i++)
                                        {
                                            if(content[i].topicid == topicindex)
                                            {
                                                $("#contents").html("<div><p><h4 style='text-align:left;'>" + content[i].topics + "</h4></p></div>" 
                                                + "<div style='text-align:left;'>" + content[i].content + "</div>");
                                                break;
                                            }
                                        }
                                    }
                                </script>
                        </div><!--card section -->
                    </div><!--container section -->
                </div>
                <!-- Div Container to be shadow-boxed ends-->

            </div>

 </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script>
    <!-- Plugin JavaScript -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
    <script src="js/jquery.easing.min.js"></script>
    <!-- Theme JavaScript -->
    <script src="js/scrolls.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            if(sessionStorage.getItem("success") == "yes")
                    {
                        $.notify({
                                // options
                                icon: 'glyphicon glyphicon-success',
                                title: 'Happy Learning!',
                                message: 'You have enrolled successfully for the course!',
                                url: '#',
                                target: '_blank'
                            },{
                                // settings
                                element: 'body',
                                position: null,
                                type: "success",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: false,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                timer: 1000,
                                url_target: '_blank',
                                mouse_over: null,
                                animate: {
                                    enter: 'animated zoomInDown',
                                    exit: 'animated zoomOutUp'
                                },
                                onShow: null,
                                onShown: null,
                                onClose: null,
                                onClosed: null,
                                icon_type: 'class',
                                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    '</div>' +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                '</div>' 
                            });
                            sessionStorage.setItem("success","");
                }
                if(sessionStorage.getItem("success") == "no")
                    {
                        $.notify({
                                // options
                                icon: 'glyphicon glyphicon-success',
                                title: 'Oops!',
                                message: 'We faced issue while enrolling you! Please contact support team!',
                                url: '#',
                                target: '_blank'
                            },{
                                // settings
                                element: 'body',
                                position: null,
                                type: "danger",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: false,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                timer: 1000,
                                url_target: '_blank',
                                mouse_over: null,
                                animate: {
                                    enter: 'animated zoomInDown',
                                    exit: 'animated zoomOutUp'
                                },
                                onShow: null,
                                onShown: null,
                                onClose: null,
                                onClosed: null,
                                icon_type: 'class',
                                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    '</div>' +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                '</div>' 
                            });
                            sessionStorage.setItem("success","");
                }
        });
        function enroll(){
            <?php 
                if(!isset($_COOKIE["login_name"]))
                {
            ?>
                $('#alertModal').modal('show');
            <?php
                }
                else
                {
            ?>
            $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: "enroll.php",
                    data: { username: "<?php echo base64_encode($_COOKIE["login_name"]);?>",
                    courseid: "<?php echo base64_encode($courseid)?>" }
                    })
                    .done(function( msg ) {                        
                       sessionStorage.setItem("success","yes");
                       window.location.reload();
                    })
                    .fail(function() {
                        sessionStorage.setItem("success","no");
                        window.location.reload();
                    });  
            }); 
            <?php
                }
            ?>
        } 
    </script>
</body>

</html>
