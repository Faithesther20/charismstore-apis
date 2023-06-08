<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookstoredb";

// Create a new MySQLi object
$mysqli = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
