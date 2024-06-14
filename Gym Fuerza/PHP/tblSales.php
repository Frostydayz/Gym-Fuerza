<?php
//connect
    $connect = new mysqli('localhost', 'root', '', 'gym_fuerza');

//Declaring of variables
    $selectQuery = "SELECT * FROM salesreport";
    $Data = $connect->query($selectQuery);

    echo "<tr>
            <td colspan=3 id='tblTitle'>
                Daily Revenue Summary
            </td>
        </tr>
        <tr>
            <th>Date</th>
            <th>Visitors</th>
            <th>Total Earned</th>
        </tr>";
        
    while ($row = $Data->fetch_assoc()){
    echo "            
        <tr>
            <td>" . $row['ReportDate']  . "</td>
            <td>" . $row['Visitors'] . "</td>
            <td>" . $row['TotalEarnings']. "</td>
        </tr>";
    }
?>