<?php 
    session_start();
    include('../common/server.php');
    $id = (int)$_POST["live_id"]; 
    $band = $_POST["band"]; 
    $memname = $_POST["memname"];
    $datelive = $_POST["datelive"];
    $livetime = $_POST["livetime"];    
    $Platform = $_POST["Platform"]; 
        $sql_insert = "UPDATE memlive SET band='$band',member = '$memname',date ='$datelive', time='$livetime',platform = '$Platform' WHERE live_id = '$id'";
        $result_insert = mysqli_query($conn, $sql_insert);
        
        mysqli_close($conn);
        $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ";
        header("Location: ./index.php");
?>