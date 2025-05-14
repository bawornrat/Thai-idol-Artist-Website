<?php
    session_start();
    include('../common/server.php');
    
    $sql = "SELECT * FROM event WHERE end_date >= CURRENT_DATE() ORDER BY start_date ASC";
    $resultQuery = mysqli_query($conn, $sql);

    $resultArray = array();
    while($obResult = mysqli_fetch_array($resultQuery)){
        array_push($resultArray,$obResult);
    }

    mysqli_close($conn);
    echo json_encode($resultArray);
?>