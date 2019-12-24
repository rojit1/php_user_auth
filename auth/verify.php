<?php 

    include('../config.php');

    if(isset($_GET['v_key'])){
        $v_key = $_GET['v_key'];
        $q = "SELECT * FROM users WHERE v_key='$v_key' AND status='0' limit 1";
        $res = mysqli_query($con,$q);
        $count = mysqli_num_rows($res);
        if($count > 0){
            $account = mysqli_fetch_assoc($res);
            $id = $account['id'];
            $upd = "UPDATE users SET status='1' where id=$id";
            $result = $con->query($upd);
            if($result){
            header('location:login.php');
            }else{
                echo 'something went wrong';
            }
            
        }else{
            echo 'Sorry account is already verified or disabled';
        }
        

    }


?>