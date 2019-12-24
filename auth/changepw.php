<?php

    session_start();
    $email = $_SESSION['email'];
    include('../config.php');
    if(isset($_POST['submit'])){
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $c_password = mysqli_real_escape_string($con,$_POST['c_password']);
        if($password == $c_password){
            
            $password = password_hash($password,PASSWORD_DEFAULT);
            $q = "UPDATE users set password='$password' WHERE email='$email'";
            $res = $con->query($q);
            if($res){
                header('location:login.php');
            }else{
                echo 'please try again later';
            }
            

        }else{
            echo 'Password doesnot match';
        }

    }

?>

<form action="changepw.php" method="POST">

    <table>
        <tr>
            <td>New Password</td>
            <td><input type="password" name="password" ></td>
        </tr>

        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="c_password" ></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Change"></td>
        </tr>
    </table>

</form>