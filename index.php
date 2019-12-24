<?php

session_start();
if(!isset($_SESSION['username']) && empty($_COOKIE['username'])){
    header('location:auth/login.php');
}

?>
<h2>Welcome <?php echo $_SESSION['username']??$_COOKIE['username'].' from cookie'; ?></h2>

<a href="logout.php">logout</a>