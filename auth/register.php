<?php  

    include_once('../config.php');

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $c_password = mysqli_real_escape_string($con,$_POST['c_password']);
        if(!empty($username) && !empty($email) && !empty($password) &&!empty($c_password)){

            if($password == $c_password){
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $v_key = md5(time().rand(100,1000));
                $q = "INSERT INTO users VALUES('','$username','$email','$hash','$v_key',0)";
                $res = $con->query($q);
                if($res){

                    $msg="<a href='http://localhost/php/auth/verify.php?v_key=$v_key'>Click Here to verify</a>";
                    $to = $email;
                    $subject = "Verify Acount";
                    $mailheaders = "From: My usersite <gmail@rojit.com>\n";
                    if(mail($to, $subject, $msg, $mailheaders)){
                        echo '<h1>Check your mail to verify your account</h1>';
                    }else{
                        echo 'Error occoured';
                    }

                }else{
                    echo 'Please Try again';
                }

                

            }else{
                echo 'Password and confirm password doesnot match';
            }

        }else{
            echo 'Every fields are required';
        }


    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <form action="register.php" method="POST">

        <table>

            <tr>
                <td>Username : </td>
                <td><input type="text" name="username"></td>
            </tr>

            <tr>
                <td>Email : </td>
                <td><input type="email" name="email"></td>
            </tr>

            <tr>
                <td>Password : </td>
                <td><input type="password" name="password"></td>
            </tr>

            <tr>
                <td>Confirm Password : </td>
                <td><input type="password" name="c_password"></td>
            </tr>

            

            <tr>
            <td></td>
            
            <td> <input type="submit" name="submit" value="Register"></td>
            </tr>
        </table>

    </form>

</body>
</html>