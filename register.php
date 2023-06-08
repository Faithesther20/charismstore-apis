<?php
include 'connection.php';

// Retrieve the raw JSON payload
// $jsonPayload = file_get_contents('php://input');

// // Decode the JSON into an associative array
// $data = json_decode($jsonPayload, true);

$name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$isAdmin = $_POST['isAdmin'];

// Debugging statements
echo "Name: " . $name . "<br>";
echo "Email: " . $email . "<br>";
echo "Password: " . $password . "<br>";
echo "isAdmin: " . $isAdmin . "<br>";

// Prepare and execute the INSERT query
$query = "INSERT INTO users (name, email, password, isAdmin) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssss", $name, $email, $password, $isAdmin);
$stmt->execute();

// Check if the query was successful
if ($stmt) {
    $message = "Registration successful!";
} else {
  $message = "Error: " . $mysqli->error;
}

// Close the statement and the connection
$stmt->close();
$response[] = array("message"=>$message);
echo json_encode($response);
$mysqli->close();
?>
