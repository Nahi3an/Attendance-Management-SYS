<?php

/* Connecting to the server */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentAttendanceManagementSys";

/**Connecting to the Database */
$conn = mysqli_connect($servername,  $username, $password,  $dbname);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

