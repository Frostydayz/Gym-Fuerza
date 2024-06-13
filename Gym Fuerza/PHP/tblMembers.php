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

echo '
<div id="MembersBody">
        <table class="MemberList">
            <thead>
                <tr class="Header">
                    <th colspan="2">Registered Members</th>
                    <th colspan="2">Non-Registered Members</th>
                </tr>
                <tr>
                    <th>Regular</th>
                    <th>Student</th>
                    <th>Regular</th>
                    <th>Student</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><table id="tblMlist">'; 
// Regular Student Registered Members
while ($row = $CreateMR->fetch_assoc()) {
    echo '<tr><td id ="' . $row["GymGoerID"] . '">' . $row["Name"] . '</td><td><button id="btnEdit" onclick=Edit()>
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

echo '</table></td>
                </tr>
            </tbody>
        </table>
</div>';

?>
