<?php 
    session_start();
    include('../common/server.php');
    $id = (int)$_GET["comment"];
    $bandid = (int)$_GET["bandid"];
    $sql_delete = "DELETE from comment WHERE comment_id = $id";
    $result = mysqli_query($conn,$sql_delete);
    if($result){
        $_SESSION['success'] = "ลบข้อมูลสำเร็จ";
        mysqli_close($conn);
        header("Location:./view.php?bandid=".$bandid);
    }
?>