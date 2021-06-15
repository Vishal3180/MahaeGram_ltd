<?php
$servername = "localhost";
  $username = "u732064555_testSandesh";
  $password = "Sandesh@151";
  $dbname = "u732064555_testmahaegram";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


?>
