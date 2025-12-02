<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "practical_exam";

$con = new mysqli($host, $user, $pass, $db_name);

if ($con->connect_error) {
    die("Failed to connect MySQL: " . $con->connect_error);
}

$con->set_charset("utf8mb4");
?>
