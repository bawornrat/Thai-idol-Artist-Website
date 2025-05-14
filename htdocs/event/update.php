<?php 
    session_start();
    include('../common/server.php');
    $id = (int)$_POST["event_id"]; 
    $event = $_POST["eventname"]; 
    $place = $_POST["placeName"];
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];    
    $startdate = $_POST["start_date"];
    $enddate = $_POST["end_date"];    
    $Eventdetail = $_POST["eventdetail"];
    
    $username = $_SESSION['username'];

    if(empty($_POST['eventdetail'])){
        $sql_insert = "UPDATE event SET username='$username', eventname='$event', place='$place', lat='$lat', lng='$lng', start_date='$startdate', end_date='$enddate' where event_id='$id'";
        $result_insert = mysqli_query($conn,$sql_insert);
      }else {
        $sql_insert = "UPDATE event SET username='$username', eventname='$event', place='$place', lat='$lat', lng='$lng', start_date='$startdate', end_date='$enddate', eventdetail='$Eventdetail' where event_id='$id'";
        $result_insert = mysqli_query($conn,$sql_insert);
      }
        
        mysqli_close($conn);
        $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ";
        header("Location: ./index.php");
?>