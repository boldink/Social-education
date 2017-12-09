<?php
    $cn = mysqli_connect("localhost", "root", "db_elearn", "db_elearn");
    $userid=$_POST["username"];
    $courseid = $_POST["courseid"];
    echo $userid;
    echo $courseid;
    
            $uid = base64_decode($userid);
            $cid = base64_decode($courseid);
            echo "<script type='text/javascript>'";
            echo "alert(". $uid .")";
            echo "alert(". $cid .")";
            $enrolluser = mysqli_query($cn,"CALL EnrollToCourse('$uid','$cid')") or die("Query fail: " . mysqli_error($cn));
            
            return 1;
        
?>