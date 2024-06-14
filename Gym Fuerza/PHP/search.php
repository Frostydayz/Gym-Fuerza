<?php
//declaring of variables
date_default_timezone_set('Asia/Manila');
$M_Type = $_POST['M_Type'];
$Name = $_POST['searchbar'];
$D_Type = $_POST['D_Type'];
$TimeIn = date("Y-m-d H:i:s");
$DiscountID = 5;

//connecting
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the name exists in gymgoer table
$checkExisting = $connect->prepare("SELECT GymGoerID, DiscountID FROM gymgoer WHERE Name = ?");
$checkExisting->bind_param("s", $Name);
$checkExisting->execute();
$checkExisting->store_result();
$count = $checkExisting->num_rows;
$checkExisting->bind_result($gymGoerID, $existingDiscountID);
$checkExisting->fetch();
$checkExisting->close();

if ($count > 0) {
    $selectAmount = "SELECT discount.isStudent, discount.isMember, discount.AmountEarned
    FROM gymgoer
    JOIN discount ON gymgoer.DiscountID = discount.DiscountID
    WHERE GymGoerID = $gymGoerID";
    
    $DiscountDetails = $connect->query($selectAmount);
    $result = $DiscountDetails->fetch_assoc();
    $citizenship = $result['isStudent'];
    $Membership = $result['isMember'];
    $AmountEarned = $result['AmountEarned'];


    // Insert into logs table
    $insertLogs = "INSERT INTO logs(GymGoerID, TimeIn, AmountEarned) VALUES (?, ?, ?)";
    $addLogs = $connect->prepare($insertLogs);
    $addLogs->bind_param("isi", $gymGoerID, $TimeIn, $AmountEarned);  
    $addLogs->execute();

} else {
    if ($M_Type == "Members" && $D_Type == "Students") {
        $DiscountID = 1;
    } else if ($M_Type == "Members" && $D_Type == "Regulars") {
        $DiscountID = 2;
    } else if ($M_Type == "NonMembers" && $D_Type == "Students") {
        $DiscountID = 3;
    } else {
        $DiscountID = 4;
    }

    // Add data from searchbar
    $InsertGymgoer = "INSERT INTO gymgoer(Name, DiscountID) VALUES (?, ?)";
    $AddData = $connect->prepare($InsertGymgoer);
    $AddData->bind_param("si", $Name, $DiscountID);
    $AddData->execute();

    //Retrieving GymGoerID
    $gymGoerID = $connect->insert_id;
    
    //Select Amount Earned
    $selectAmount = "SELECT discount.isStudent, discount.isMember, discount.AmountEarned
                    FROM gymgoer
                    JOIN discount ON gymgoer.DiscountID = discount.DiscountID
                   WHERE discount.DiscountID = $DiscountID";


    $DiscountDetails = $connect->query($selectAmount);
    $result = $DiscountDetails->fetch_assoc();
    $citizenship = $result['isStudent'];
    $Membership = $result['isMember'];
    $AmountEarned = $result['AmountEarned'];


    //Add data into logs
    $InsertLogs = "INSERT INTO logs(GymGoerID, TimeIn, AmountEarned) VALUES (?, ?, ?)";
    $AddLogs = $connect->prepare($InsertLogs);
    $AddLogs->bind_param("isi", $gymGoerID, $TimeIn, $AmountEarned);
    $AddLogs->execute();
}

// Closing connection
$connect->close();

?>
