<?php
    
    $servername="localhost";
    $user="robert";
    $password="(removed)";
    $database="rcms";

    $conn = new mysqli($servername, $user, $password, $database);
    if($conn->connect_error){
        die("Connection failed: " .$conn->connect_error);
    }
?>

