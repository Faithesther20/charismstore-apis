<?php
// Establish database connection (replace with your own credentials)
include 'connection.php';


// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch book data from the database
$query = "SELECT * FROM books";
$result = $mysqli->query($query);

// Convert the result to an associative array
$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

// Output the JSON data
header('Content-Type: application/json');
echo json_encode($books);

// Close the database connection
$mysqli->close();
?>
