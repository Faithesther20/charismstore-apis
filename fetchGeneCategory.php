<?php
include 'connection.php';

// Fetch the first 6 categories
$query = "SELECT * FROM bookcategories LIMIT 6";
$result = mysqli_query($mysqli, $query);

if ($result) {
  $categories = array();
  
  // Loop through the result and fetch each category
  while ($row = mysqli_fetch_assoc($result)) {
    $category = array(
      'id' => $row['categoryId'],
      'name' => $row['category'],
      'image' => $row['categoryImage']
      // Add other relevant category fields
    );
    
    $categories[] = $category;
  }

  // Return the categories as JSON
  header('Content-Type: application/json');
  echo json_encode($categories);
} else {
  // Handle the query error
  echo "Error executing the query: " . mysqli_error($mysqli);
}
?>
