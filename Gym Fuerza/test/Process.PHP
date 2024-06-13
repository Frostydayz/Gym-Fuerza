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

/* Old Code

// Connection to Database
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Declaration of Variables
$M_Type = $_POST['M_Type'];
$Name = $_POST['searchbar'];
$D_Type = $_POST['D_Type'];
$TimeIn = date("Y-m-d H:i:s");
$DiscountID = 5;

// Determine DiscountID
if ($M_Type == "Members" && $D_Type == "Students") {
    $DiscountID = 1;
} else if ($M_Type == "Members" && $D_Type == "Regulars") {
    $DiscountID = 2;
} else if ($M_Type == "NonMembers" && $D_Type == "Students") {
    $DiscountID = 3;
} else {
    $DiscountID = 4;  
}

// Check if gymgoer exists
$stmt = $connect->prepare("SELECT GymGoerID FROM gymgoer WHERE Name = ?");
$stmt->bind_param('s', $Name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Gymgoer exists
    $row = $result->fetch_assoc();
    $GymGoerID = $row['GymGoerID'];
} else {
    // Insert new gymgoer
    $insertGymgoer = $connect->prepare("INSERT INTO gymgoer (Name, DiscountID) VALUES (?, ?)");
    $insertGymgoer->bind_param('si', $Name, $DiscountID);
    $insertGymgoer->execute();
    $GymGoerID = $connect->insert_id;
    $insertGymgoer->close();
}

// Insert into logs
$selectAmountEarned = "SELECT AmountEarned FROM discount WHERE DiscountID = ?";
$stmt = $connect->prepare($selectAmountEarned);
$stmt->bind_param('i', $DiscountID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$AmountEarned = $row['AmountEarned'];

$insertLogs = $connect->prepare("INSERT INTO logs (GymGoerID, TimeIn, AmountEarned) VALUES (?, ?, ?)");
$insertLogs->bind_param('isi', $GymGoerID, $TimeIn, $AmountEarned);
$insertLogs->execute();

$connect->close();
header('Location: ../HTML/index.html');

*/
?>
