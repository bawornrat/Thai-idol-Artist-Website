<?php
    session_start();
    include('../common/server.php');
    $errors = array();
    if(isset($_POST['login'])){
        $user_name = mysqli_real_escape_string($conn,$_POST['username']);
        $pswd = mysqli_real_escape_string($conn,$_POST['pswd']);


        if(empty($user_name)){
           array_push($errors,"ต้องใส่ Username");
        }
        if(empty($pswd)){
            array_push($errors,"ต้องใส่รหัสผ่าน");
        }

        if(count($errors) ==0){
            $query ="SELECT * FROM user WHERE username ='$user_name'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) ==1){
                while($row = mysqli_fetch_array($result)){
                    if(password_verify($pswd,$row['password'])){
                        $_SESSION['username'] = $user_name;
                        $_SESSION['success'] = "ตอนนี้คุณได้เข้าสู่ระบบแล้ว";
                        header('location: ../index.php');
                    } else {
                        array_push($errors, "ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง");
                        $_SESSION['error'] = "ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง";
                        header('location: login.php');
                    }
                }
            } else {
                array_push($errors, "ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง");
                $_SESSION['error'] = "ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง";
                header('location: login.php');
            }
        } else {
            array_push($errors, "ต้องใส่ชื่อผู้ใช้ และรหัสผ่าน");
            $_SESSION['error'] = "ต้องใส่ชื่อผู้ใช้ และรหัสผ่าน";
            header("location: login.php");
        }
        mysqli_close($conn);
    }
?>