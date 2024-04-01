<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_system";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES 'utf8' ");
date_default_timezone_set('Asia/Bangkok');

//check connection
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
