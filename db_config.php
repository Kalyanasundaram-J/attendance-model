<?php
    $servername = "127.0.0.1";
    $username = "admin";
    $password = "admin@123";
    $dbname = "attendance_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>