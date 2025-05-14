<?php
    session_start();
    include('../common/server.php');

    $errors = array();

    if(isset($_POST['regisuser'])){
        $user_name = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pswd = mysqli_real_escape_string($conn,$_POST['pswd']);
        $re_pswd = mysqli_real_escape_string($conn,$_POST['re-pswd']);


        if(empty($user_name)){
           array_push($errors,"ต้องใส่ Username");
           $_SESSION['error'] = "ต้องใส่ Username";
        }
        if(empty($email)){
            array_push($errors,"ต้องใส่ E-mail");
            $_SESSION['error'] = "ต้องใส่ E-mail";
        }
        if(empty($pswd)){
            array_push($errors,"ต้องใส่รหัสผ่าน");
            $_SESSION['error'] = "ต้องใส่รหัสผ่าน";
        }
        if($pswd != $re_pswd){
            array_push($errors,"รหัสผ่านไม่ตรงกัน");
            $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        }

        $user_check_query ="SELECT * FROM user WHERE username ='$user_name' OR email = '$email'";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){
            if($result['username'] ===$user_name){
                array_push($errors,"Username นี้ถูกใช้ไปแล้ว");
                $_SESSION['error'] = "Username นี้ถูกใช้ไปแล้ว";
            }
            if($result['email'] ===$email){
                array_push($errors,"E-mail นี้ถูกใช้ไปแล้ว");
                $_SESSION['error'] = "E-mail นี้ถูกใช้ไปแล้ว";
            }
        }
        if(count($errors) ==0){
            $password = password_hash($pswd,PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (username, email,password) VALUES ('$user_name','$email','$password')";
            mysqli_query($conn,$sql);

            $_SESSION['username'] = $user_name;
            $_SESSION['success'] = "ตอนนี้คุณได้เข้าสู่ระบบแล้ว";
            header('location: ../index.php');
        } else {
            header('location: signup.php');
        }
        mysqli_close($conn);
    }
?>