<?php
include 'connection.php';

// Prepare the SQL statement for inserting into orderProducts table
$insertOrderProductsStmt = $mysqli->prepare("INSERT INTO orders (userId, bookId, name, quantity, price) VALUES (?, ?, ?, ?, ?)");

// Retrieve the JSON data from the request
$jsonData = file_get_contents('php://input');

// Decode the JSON data into a PHP array
$requestData = json_decode($jsonData, true);

if(isset($requestData['cartItems'])){
    $cartItems = $requestData['cartItems'];
    

    // Start the transaction
    $mysqli->begin_transaction();
    try {
        // Iterate over each cart item and execute the insert statement
        foreach ($cartItems as $cartItem) {
            $userId = $cartItem['userId'];
            $bookId = $cartItem['bookId'];
            $name = $cartItem['name'];
            $quantity = $cartItem['quantity'];
            $price = $cartItem['quantity'] * $cartItem['price'];
    
            // Bind the parameters and execute the statement
            $insertOrderProductsStmt->bind_param("iisid", $userId, $bookId, $name, $quantity, $price);
            // $insertOrderProductsStmt->execute();
            if (!$insertOrderProductsStmt->execute()) {
                echo "SQL Error: " . $insertOrderProductsStmt->error;
            } 
        }
    
        // Commit the transaction
        $mysqli->commit();
    
        // Close the prepared statement
        $insertOrderProductsStmt->close();
    
        // Send a success response
        echo "Cart items inserted successfully!";
    } catch (Exception $e) {
        // Rollback the transaction if an error occurred
        $mysqli->rollback();
    
        // Close the prepared statement
        $insertOrderProductsStmt->close();
    
        // Send an error response
        echo "Error: " . $e->getMessage();
    }
    
    // Close the database connection
    $mysqli->close();
} else {
    echo "An error occurred: 'cartItems' not found in the request.";
}
?>
