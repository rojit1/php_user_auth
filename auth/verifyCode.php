<?php 
    session_start();
    include('../config.php');
    $code = $_SESSION['code'];
    
    if(isset($_POST['submit'])){
        $c = mysqli_real_escape_string($con,$_POST['code']);
        if($c == $code){
            header('location:changepw.php');
        }else{
            echo 'Code doesnot match';
        }
    }


?>

<form action="verifyCode.php" method="POST">
    <label>Enter code here</label>
    <input type="text" name="code" id="">
    <input type="submit" name="submit" value="Submit">
</form>