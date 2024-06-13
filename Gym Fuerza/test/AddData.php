<?php
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $Discount = $_POST['Discount'];
    $M_Type = $_POST['M_Type'];

//Connect
$connect = new mysqli('localhost', 'root', '','gym_fuerza');

$AddData = $connect->prepare("insert into test(firstName, lastName, Discount, M_Type)
values(?,?,?,?)");

$AddData->bind_param("ssss", $fName, $lName, $Discount, $M_Type);
$AddData->execute();


?>  