<?php
include "connection.php";

// Retrieve the form data

$userId = $_POST['userId'];
$country = $_POST['country'];
$zipCode = $_POST['zipCode'];
$state = $_POST['state'];
$city = $_POST['city'];
$street = $_POST['street'];                                                                                                                                                                 


$stmt = $mysqli->prepare("INSERT INTO billingaddress (userId, country, zip , state_, city, street) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $userId,$country, $zipCode, $state, $city, $street);
$stmt->execute();
$stmt->close();

$mysqli->close();                                               

// Return a response if needed
$response = [
  "message" => "Billing address submitted successfully"
];
header("Content-Type: application/json");
echo json_encode($response);
?>
