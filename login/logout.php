<?php
    unset($_COOKIE["login_name"]);
    unset($_COOKIE["userfirstname"]);
    setcookie("login_name",'',-1,'/','localhost');
    setcookie("userfirstname",'',-1,'/','localhost');
    header("Location:../index.php");
?>