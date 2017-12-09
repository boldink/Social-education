 <?php 
    include_once("DBCON/database.php");
    
 ?>
 <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    <i class="fa fa-play-circle"></i> Bold<span class="light">ink</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php
                        $cookieisset = isset($_COOKIE["login_name"]); 
                        $result = mysqli_query($cn,"CALL GetAllMenu") or die("Query fail: " . mysqli_error());
                        if($cookieisset){
                            while ($row = mysqli_fetch_array($result))
                            {
                                if($row[1] === "LOGIN/REGISTER")
                                {
                                    echo "<li><a class=\"page-scroll\" style='display:none;' href=\"". $row[2] ."\" >". $row[1] ."</a>";
                                }
                                else{
                                    echo "<li><a class=\"page-scroll\" href=\"". $row[2] ."\" >". $row[1] ."</a>";
                                }
                                
                                
                            }
                            echo "<li><a class=\"page-scroll\" href=\"myprofile.php\" > Welcome " .  $_COOKIE["userfirstname"] . "</a>";
                            echo "<li><a class=\"page-scroll\" href=\"login/logout.php\" >Logout</a>";                            
                            echo "</li>";
                        }                        
                        else
                        {
                            while ($row = mysqli_fetch_array($result))
                            {
                                echo "<li><a class=\"page-scroll\" href=\"". $row[2] ."\" >". $row[1] ."</a>";
                                echo "</li>";
                            }
                        }
                        //mysqli_close($cn);
                    ?>
                    <li>
                        <input class="searchBox" type="text" name="search" placeholder="Search">
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<!--</section>-->