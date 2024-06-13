<?php
//connecting
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

$SelectQuery = "SELECT logs.TimeIn, logs.LogsID, gymgoer.Name, discount.isMember, discount.isStudent, discount.AmountEarned
                FROM logs
                JOIN gymgoer ON logs.GymgoerID = gymgoer.GymgoerID
                INNER JOIN discount ON gymgoer.DiscountID =  discount.DiscountID
                ORDER BY logs.LogsID ASC;";

$sumQuery = "SELECT SUM(AmountEarned) AS TotalAmount FROM logs";
$result = $connect->query($sumQuery);
$row = $result->fetch_assoc();
$totalAmount = $row['TotalAmount'];

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Displaying table
$CreateTBL = $connect->query($SelectQuery);

if ($CreateTBL->num_rows > 0) {
    echo '
    <tr>
        <th>Time-In</th>
        <th>No.</th>  
        <th>Name</th>
        <th>Membership</th>
        <th>Citizenship</th>
        <th>Amount Earned</th>
    </tr>
    <tbody id="tblBody">';
    while ($row = $CreateTBL->fetch_assoc()) {
            $M_Type = $row['isMember'];
            $D_Type = $row['isStudent'];

            if ($M_Type == 1) {
                $M_Type = "Member";
            }
            else {
                $M_Type = "Non-Member";
            }

            if ($D_Type == 1) {
                $D_Type = "Student";
            }
            else {
                $D_Type = "Regular";
            }
            
        echo "<tr>
                <td>" . $row["TimeIn"] . "</td>
                <td>" . $row["LogsID"] . "</td>
                <td>" . $row["Name"] . "</td>
                <td>" . $M_Type . "</td>
                <td>" . $D_Type . "</td>
                <td>" . $row["AmountEarned"] . "</td>
            </tr>";
    }
        echo "<tr><td id='Total' colspan='5'> Total Amount: </td> <td>" . $totalAmount . "</td></tr>"; 

} else {
    echo "<tr><td colspan='5'>0 results</td></tr>";
}

$connect->close();
?>
