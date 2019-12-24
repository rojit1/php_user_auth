<?php
session_start();
include('../config.php');

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $q = "SELECT * FROM users WHERE email = '$email' limit 1";
    $res = mysqli_query($con,$q);
    if(mysqli_num_rows($res)==1){
        $code = rand(10000,99999);
        $_SESSION['code'] = $code;
        $_SESSION['email'] = $email;
        $msg=$code;
        $to = $email;
        $subject = "Reset Password";
        $mailheaders = "From: My usersite <gmail123@rojit.com>\n";
        if(mail($to, $subject, $msg, $mailheaders)){
            header('location:verifycode.php');
        }else{
            echo 'Error occoured';
        }
    }else{
        echo 'Email doesnot exist';
    }
}

?>

<form action="" method="POST">
    <p>Enter your email to send code</p>
    <label>Email</label>
    <input type="email" name="email">
    <input type="submit" name="submit" value="Send Code">
</form>