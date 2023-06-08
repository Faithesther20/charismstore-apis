<?php
include 'connection.php';
// Get the book ID from the POST request
$bookId = $_POST['bookId'];

// Connect to your database

// Create a connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Prepare and execute the SQL query to select the book details
// Prepare the SQL statement with a parameter placeholder
$sql = "SELECT * FROM books WHERE bookid = ?";
$stmt = $mysqli                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ->prepare($sql);

// Bind the parameter value to the statement
$stmt->bind_param("i", $bookId);

// Execute the statement
$stmt->execute();

// Get the result                                            
$result = $stmt->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch the book details
    $row = $result->fetch_assoc();

    // Return the book details as JSON response
    echo json_encode($row);
} else {
    // Book not found
    echo "Book not found";
}

// Close the statement
$stmt->close();

?>
