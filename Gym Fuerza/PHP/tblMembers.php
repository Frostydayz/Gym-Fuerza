<?php

//connecting
$connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$FilterMS = "SELECT * FROM gymgoer WHERE DiscountID = 1";
$FilterMR = "SELECT * FROM gymgoer WHERE DiscountID = 2";
$FilterNMS = "SELECT * FROM gymgoer WHERE DiscountID = 3";
$FilterNMR = "SELECT * FROM gymgoer WHERE DiscountID = 4";

$CreateMS = $connect->query($FilterMS);
$CreateMR = $connect->query($FilterMR);
$CreateNMS = $connect->query($FilterNMS);
$CreateNMR = $connect->query($FilterNMR);

//selecting count
$SelectCountMS = "SELECT COUNT(*) AS CountMS FROM gymgoer WHERE DiscountID = 1";
$CountMS = $connect->query($SelectCountMS);
$CountRowMS = $CountMS->fetch_assoc();
$MSCount = $CountRowMS['CountMS'];

$SelectCountMR = "SELECT COUNT(*) AS CountMR FROM gymgoer WHERE DiscountID = 2";
$CountMR = $connect->query($SelectCountMR);
$CountRowMR = $CountMR->fetch_assoc();
$MRCount = $CountRowMR['CountMR'];

$SelectCountNMS = "SELECT COUNT(*) AS CountNMS FROM gymgoer WHERE DiscountID = 3";
$CountNMS = $connect->query($SelectCountNMS);
$CountRowNMS = $CountNMS->fetch_assoc();
$NMSCount = $CountRowNMS['CountNMS'];

$SelectCountNMR = "SELECT COUNT(*) AS CountNMR FROM gymgoer WHERE DiscountID = 4";
$CountNMR = $connect->query($SelectCountNMR);
$CountRowNMR = $CountNMR->fetch_assoc();
$NMRCount = $CountRowNMR['CountNMR'];

//Displaying Table
echo '
<div id="MembersBody">
        <table class="MemberList">
            <thead>
                <tr class="Header">
                    <th colspan="2">Registered Members</th>
                    <th colspan="2">Non-Registered Members</th>
                </tr>
                <tr id="Citizenship">
                    <th>Regular</th>
                    <th>Student</th>
                    <th>Regular</th>
                    <th>Student</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><table id="tblMlist">'; 
// Regular Registered Members
while ($row = $CreateMR->fetch_assoc()) {
    echo '<tr><td id ="' . $row["GymGoerID"] . '">' . $row["Name"] . '</td><td><button id="btnEdit" onclick=Edit(event)>
            <i class="fa-solid fa-pen-to-square"></i>
            </button></td></tr>';
}
echo '</table></td>
<td><table id="tblMlist">';

// Student Registered Members
while ($row = $CreateMS->fetch_assoc()) {
    echo '<tr><td id ="' . $row["GymGoerID"] . '">' . $row["Name"] . '</td><td><button id="btnEdit" onclick="Edit(event)">
            <i class="fa-solid fa-pen-to-square"></i>
            </button></td></tr>';
}
echo '</table></td>
<td><table id="tblMlist">'; 

// Regular Non-Registered Members
while ($row = $CreateNMR->fetch_assoc()) {
    echo '<tr><td id ="' . $row["GymGoerID"] . '">' . $row["Name"] . '</td><td><button id="btnEdit" onclick= "Edit(event)">
        <i class="fa-solid fa-pen-to-square"></i>
            </button></td></tr>';
}
echo '</table></td>
<td><table id="tblMlist">';

// Student Non-Registered Members
while ($row = $CreateNMS->fetch_assoc()) {
    echo '<tr><td id ="' . $row["GymGoerID"] . '">' . $row["Name"] . '</td><td><button id="btnEdit" onclick="Edit(event)">
            <i class="fa-solid fa-pen-to-square"></i>
            </button></td></tr>';
}

//Displaying end of table and Member Count
echo '</table></td>
                </tr>
                <tr id="ttlVisitors">
                    <td>
                    TOTAL: ' . $MRCount .'
                    </td>

                    
                    <td>
                    TOTAL: '. $MSCount .'
                    </td>

                    
                    <td>
                    TOTAL: '. $NMRCount .'
                    </td>

                    
                    <td>
                    TOTAL: '. $NMSCount .'
                    </td>
                </tr>
            </tbody>
        </table>
</div>';

?>
