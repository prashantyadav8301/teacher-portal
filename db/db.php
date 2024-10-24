<?php

$server = "localhost";
$usernames = "root";
$password = "";
$database = "tailwebs";

// Create connection
$conn = new mysqli($server, $usernames, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: $conn->connect_error");
}
