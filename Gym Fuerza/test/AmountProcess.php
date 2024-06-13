<?php
header('Content-Type: application/json');

// Get the raw POST data
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);

$amountEarned = $data['amountEarned'];
$gymGoerID = $data['gymGoerID']; // Assuming gymGoerID is passed from the client side

// Database connection
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Prepare and execute query to insert amount earned into the logs table
$insertLogs = $connect->prepare("INSERT INTO logs (GymGoerID, TimeIn, AmountEarned) VALUES (?, NOW(), ?)");
$insertLogs->bind_param('ii', $gymGoerID, $amountEarned);

$response = array();

if ($insertLogs->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Log entry successfully inserted into the database.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to insert log entry into the database.';
}

// Close prepared statement and database connection
$insertLogs->close();
$connect->close();

// Return JSON response
echo json_encode($response);
?>