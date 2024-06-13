<?php
header('Content-Type: application/json');

// Database connection
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$gymGoerID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($gymGoerID > 0) {
    $stmt = $connect->prepare("
        SELECT g.GymGoerID, g.Name, d.isMember, d.isStudent
        FROM gymgoer g
        JOIN discount d ON g.DiscountID = d.DiscountID
        WHERE g.GymGoerID = ?
    ");
    $stmt->bind_param('i', $gymGoerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $gymgoer = $result->fetch_assoc();
        echo json_encode($gymgoer);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
} else {
    echo json_encode(null);
}

$connect->close();
?>  