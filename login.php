<?php
include 'connection.php';

// Collect user input from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the SELECT query
$query = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $mysqli->prepare($query);

// Check if the prepared statement was executed successfully
if (!$stmt) {
  $message = "Error: " . $mysqli->error;
  $userId = null; // Set userId to null in case of error
} else {
  // Bind the parameters and execute the statement
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();

  // Check if the statement execution was successful
  if ($stmt->errno) {
    $message = "Error: " . $stmt->error;
    $userId = null; // Set userId to null in case of error
  } else {
    // Get the result set
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($row = $result->fetch_assoc()) {
      $message = "Login successful!";
      $userId = $row['userId']; // Get the user id from the result
      // Perform actions for successful login
    } else {
      $message = "Invalid email or password.";
      $userId = null; // Set userId to null for failed login
      // Perform actions for failed login
    }
  }

  // Close the statement
  $stmt->close();
}

$response = array("message" => $message, "userId" => $userId);
echo json_encode($response);
$mysqli->close();
?>