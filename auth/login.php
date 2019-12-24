
<?php
    session_start();
    include('../config.php');
    if(isset($_SESSION['username'])){
        header('location:../index.php');
    }

    if(isset($_POST['submit'])){
        $username =  mysqli_real_escape_string($con,$_POST['username']);
        $password =  mysqli_real_escape_string($con,$_POST['password']);
        $rem = $_POST['rem'] ?? 0;
        $q = "SELECT * FROM users WHERE username = '$username' limit 1;";
        $res = $con->query($q);
        if(mysqli_num_rows($res) >0){
            while($row = mysqli_fetch_assoc($res)){
                if(password_verify($password,$row['password'])){
                    $_SESSION['username'] = $username;
                    if($rem)
                        setcookie('username', $username, time() + (86400 * 30), "/"); 
                    header('location:../index.php');
                }else{
                    echo 'password doesnot match';
                }
            }
        }

    }

?>

<form action="login.php" method="POST">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Remember me</td>
            <td><input type="checkbox" value="1" name="rem"></td>
        </tr>
        <tr>
        <td></td>
        <td><a href="forgotpassword.php">Forgot password</a></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Login"></td>
        </tr>
    </table>
</form>