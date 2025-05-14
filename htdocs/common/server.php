<?php
    $servername = "noontanissorn.thanawich.com";
    $username = "ProjectCP251";
    $password = "cp251";
    $dbname = "myidolniverse";

    $conn = mysqli_connect($servername, $username, $password, $dbname); 
    if(!$conn){
        die("Failed ".mysqli_connect_error());
    } else{
    }
?>