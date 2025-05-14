<?php 
    session_start();
    include('../common/server.php');
    $id = (int)$_GET["event"]; 
    $sql_delete = "DELETE from event WHERE event_id = $id";
    $result = mysqli_query($conn,$sql_delete);
    if($result){
        $_SESSION['success'] = "ลบข้อมูลสำเร็จ";
        mysqli_close($conn);
        header("Location:./index.php");
    }
?>