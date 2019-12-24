<?php 

    session_start();
    session_destroy();
    setcookie("username", null, time() - 3600,'/'); 
    header('location:auth/login.php');

?>