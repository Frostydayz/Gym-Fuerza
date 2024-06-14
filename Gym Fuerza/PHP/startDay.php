<?php
//cocnnect
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

//declaring of variables

//ReportDate
date_default_timezone_set('Asia/Manila');
$ReportDate = date("y-m-d");


//Visitors
$SelectCount = "SELECT COUNT(*) AS Count FROM logs";
$Count = $connect->query($SelectCount);
$CountRow = $Count->fetch_assoc();
$Visitors = $CountRow['Count'];

//totalEarned
$SelectTotal = "SELECT SUM(AmountEarned) AS TotalAmount FROM logs";
$Total = $connect->query($SelectTotal);
$TotalRow = $Total  ->fetch_assoc();
$totalEarned = $TotalRow['TotalAmount'];


//Inserting to logs
$insertSales = "INSERT INTO salesreport(ReportDate, Visitors, TotalEarnings) VALUES(?,?,?)";
$Sales = $connect->prepare($insertSales);
$Sales->bind_param("sii", $ReportDate, $Visitors, $totalEarned);
$Sales->execute();  


$deleteQuery = "DELETE FROM logs";
$Delete = $connect->query($deleteQuery);


$alterAI = "ALTER TABLE logs AUTO_INCREMENT = 1";
$resetAI = $connect->query($alterAI); 


$connect->close();
header("Location: ../Pages/HomePage.php");

?>