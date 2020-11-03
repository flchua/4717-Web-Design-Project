<?php
$servername='localhost';
$username='f35ee';
$password='f35ee';
$dbname='f35ee';

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";
?>