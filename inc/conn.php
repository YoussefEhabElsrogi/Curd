<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_php_mysql";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection Faild : " . mysqli_connect_error());
}