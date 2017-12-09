<?php
    include("DBCON/database.php");
    $cookieisset = isset($_COOKIE["login_name"]); 
    
    $result = mysqli_query($cn,"CALL GetAllMenu") or die("Query fail: " . mysqli_error());
    $jsonData = array();
    while ($rowdata = $result->fetch_assoc())
    {
        array_push($jsonData,$rowdata);
    }
    mysqli_close($cn);
?>
<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="de">  <!--<![endif]-->
<head>
   
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">

    <title>Bootsnav - Bootstrap menu multi purpose header</title>

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/bootsnav.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>     
        
    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top bootsnav">

        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="container">            
            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    </ul>
            </div>
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">
                    <!--<i class="fa fa-play-circle"></i> BOLD<span class="light">INK</span>-->
                    <img src="images/logo.png" class="img-responsive"/>
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>   

    </nav>
    <!-- End Navigation -->

    <div class="clearfix"></div>

	<!-- START JAVASCRIPT -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
                        var data = <?php echo json_encode($jsonData); ?>;
                        var builddata = function () {
                            var source = [];
                            var items = [];
                            // build hierarchical source.
                            for (i = 0; i < data.length; i++) {
                                var item = data[i];
                                var label = item["Title"];
                                var parentid = item["Parent"];
                                var id = item["ID"];
                                var url = item["Url"];
                                var style = item["Style"];
                                if (items[parentid]) {
                                    var item = { parentid: parentid, label: label, url:url, style:style,item: item };
                                    if (!items[parentid].items) {
                                        items[parentid].items = [];
                                    }
                                    items[parentid].items[items[parentid].items.length] = item;
                                    items[id] = item;
                                }
                                else {
                                    items[id] = { parentid: parentid, label: label, url:url, style:style,item: item };
                                    source[id] = items[id];
                                }
                            }
                            return source;
                    }
                    var source = builddata();
                    var buildUL = function (parent, items) {
                    $.each(items, function () {
                        if (this.label) {
                            if(this.style === "megamenu")
                            {
                               var li = $("<li class=\"dropdown megamenu-fw\"></li>");
                               li.append("<a href=\""+ this.Url +"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">"+this.label+"</a>");
                               
                                if (this.items && this.items.length > 0) {
                                    var ulmegamenu = $("<ul class=\"dropdown-menu megamenu-content\" role=\"menu\"></ul>");
                                    var limegamenu = $("<li></li>");
                                    var megamenurow = $("<div class=\"row\"></div>");
                                    for(var i=0;i<this.items.length;i++)
                                    {
                                        var megamenucolmd3 = $("<div class=\"col-menu col-md-4\"></div>");
                                        $("<h5 class=\"title\">"+this.items[i].item.Title+"</h5>").appendTo(megamenucolmd3);
                                        if(this.items[i].items && this.items[i].items.length > 0)
                                        {
                                            var megamenucontentdiv = $("<div class=\"content\"></div>");
                                            var megamenumenucolul = $("<ul class=\"menu-col\"></ul>");
                                            for(var j = 0; j<this.items[i].items.length; j++)
                                            {
                                                $("<li><a href=\""+ this.items[i].items[j].url +"\">"+ this.items[i].items[j].label +"</a></li>").appendTo(megamenumenucolul);
                                            }
                                            megamenumenucolul.appendTo(megamenucontentdiv);
                                            megamenucontentdiv.appendTo(megamenucolmd3);
                                            megamenucolmd3.appendTo(megamenurow);
                                        }
                                        else
                                        {
                                            megamenucolmd3.appendTo(megamenurow);
                                        }
                                       
                                    }
                                    megamenurow.appendTo(limegamenu);
                                    limegamenu.appendTo(ulmegamenu);
                                    ulmegamenu.appendTo(li);
                                }
                                li.appendTo(parent);
                            }
                            else if(this.style === "dropdown")
                            {
                                var li = $("<li class=\"dropdown\"></li>");
                                li.append("<a href=\""+ this.url +"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">"+this.label+"</a>");
                                if (this.items && this.items.length > 0) {
                                    var uldropdown = $("<ul class=\"dropdown-menu\"></ul>");
                                    for(var i=0;i<this.items.length;i++)
                                    {
                                        
                                        if(this.items[i].items && this.items[i].items.length > 0)
                                        {
                                            var lisubdropdown = $("<li class=\"dropdown\"></li>");
                                            $("<a href=\""+ this.items[i].item.Url +"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">"+this.items[i].item.Title+"</a>").appendTo(lisubdropdown);
                                            var ulsubdropdown = $("<ul class=\"dropdown-menu\"></ul>");
                                            for(var j = 0; j<this.items[i].items.length; j++)
                                            {
                                                $("<li><a href=\""+ this.items[i].items[j].url +"\">"+ this.items[i].items[j].label +"</a></li>").appendTo(ulsubdropdown);                                                
                                            }
                                            ulsubdropdown.appendTo(lisubdropdown);
                                            lisubdropdown.appendTo(uldropdown);
                                        }
                                        else
                                        {
                                            $("<li><a href=\""+ this.items[i].item.Url +"\">"+this.items[i].item.Title+"</a></li>").appendTo(uldropdown);
                                        }
                                            
                                     }
                                     uldropdown.appendTo(li);
                                    }
                                    li.appendTo(parent);
                            }
                            // create LI element and append it to the parent element.
                            else{
                                var li = $("<li><a class="+ this.style +" href="+ this.url +">"+ this.label + "</a></li>");
                                li.appendTo(parent);
                            }
                            
                        } 
                    });
                }
                var ul = $("<ul class=\"nav navbar-nav navbar-right\" data-in=\"fadeInDown\" data-out=\"fadeOutUp\"></ul>");
                ul.appendTo("#navbar-menu");
                buildUL(ul, source);
                <?php 
                    if(!isset($_COOKIE["login_name"])) 
                    {
                        echo "var liIsloggedin = $(\"<li><a href='login/login.php'>Login</a></li>\");";
                        echo "liIsloggedin.appendTo(ul);";
                    }
                    else
                    {
                        echo "var loggedin = $(\"<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'><img src='https://farm7.staticflickr.com/6163/6195546981_200e87ddaf_b.jpg' class='img-circle' height='23px' width='23px'/> ". $_COOKIE["userfirstname"] ."</a></li>\");";
                        echo "var liIsloggedin = $(\"<ul class='dropdown-menu'><li><a href='profile.php'>Profile</a></li><li><a href='login/logout.php'>Logout</a></li></ul>\");";
                        echo "liIsloggedin.appendTo(loggedin);";
                        echo "loggedin.appendTo(ul);";
                    }
                ?>
                
                    </script>
    <!-- Bootsnavs -->
    <script src="js/bootsnav.js"></script>

</body>
</html>
