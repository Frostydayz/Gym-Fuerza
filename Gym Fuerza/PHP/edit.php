<?php
    $id = $_POST['id'];
    $Name = $_POST['Name'];
    $Discount = $_POST['D_Type'];
    $Membership = $_POST['M_Type'];
    $DiscountID = 0;
    
    if ($Membership == "Members" && $Discount == "Students") {
        $DiscountID = 1;
    } else if ($Membership == "Members" && $Discount == "Regulars") {
        $DiscountID = 2;
    } else if ($Membership == "NonMembers" && $Discount == "Students") {
        $DiscountID = 3;
    } else {
        $DiscountID = 4;  
    }

    //connecting
    $connect = new mysqli('localhost', 'root', '', 'gym_fuerza');


    $Update = "UPDATE gymgoer
                SET Name = '$Name',
                    DiscountID = '$DiscountID'
                WHERE GymGoerID = '$id'";



    $Edit = $connect->prepare($Update);
    $Edit->execute();
  header("Location: ../Pages/MembersPage.php");

?>