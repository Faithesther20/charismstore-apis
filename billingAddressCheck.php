<?php
include "connection.php";

// Get the user ID from the request
$userId = $_POST['userId'];

// Prepare the SQL statement to check if the user ID exists in the billingAddress table
$sql = "SELECT COUNT(*) AS count FROM billingAddress WHERE userId = '$userId'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];

    // Return the count as JSON response
    $response = ['count' => $count];
    echo json_encode($response);
} else {
    // If no rows are returned, return an empty response
    $response = ['count' => 0];
    echo json_encode($response);
}

// Close the database connection
$mysqli->close();

?>
