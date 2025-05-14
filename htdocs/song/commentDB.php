<?php
    session_start();
    include('../common/server.php');

    

   if(isset($_POST['comment'])){
    $idquery = $_GET['bandid'];
    $comment = mysqli_real_escape_string($conn,$_POST['comment']);
    $user_name = mysqli_real_escape_string($conn,$_POST['username']);
    
    $sql = "INSERT INTO comment (band_id,username,comment) VALUES ('$idquery','$user_name','$comment')";
    mysqli_query($conn,$sql);
    header('location: ./view.php?bandid='.$idquery);
    mysqli_close($conn);
   }
    
?>