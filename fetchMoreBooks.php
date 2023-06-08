<?php
include 'connection.php';

// Fetch the recently added books (not less than 6)
$query = "SELECT * FROM books ORDER BY RAND() LIMIT 50";
$result = mysqli_query($mysqli, $query);

if ($result) {
  $books = array();
  
  // Loop through the result and fetch each book
  while ($row = mysqli_fetch_assoc($result)) {
    $book = array(
      'id' => $row['bookId'],
      'title' => $row['name'],
      'image' => $row['bookImage'],
      'price' => $row['price']
      // Add other relevant book fields
    );
    
    $books[] = $book;
  }

  // Return the books as JSON
  header('Content-Type: application/json');
  echo json_encode($books);
} else {
  // Handle the query error
  echo "Error executing the query: " . mysqli_error($mysqli);
}
?>
