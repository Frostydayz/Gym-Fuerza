<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/Calendar.css">
    </head>
    
    <body>
        <?php
            include("Header.php");
        ?>
    <div id="CalendarNav">
        <div id="PeriodicNav">
            <button id="YearButton" value="Year"></button>
            <button id="MonthButton" value="Month"></button>
        </div>
        <div id="Sales">
            <button id="ViewSales" value="View Sales"></button>
            <button id="BackButton" value="Back"></button>
        </div>
    </div>
    <div id="CalendarBody">
    </div>

    <script>
        const button3 = document.getElementById('button3');
        const button4 = document.getElementById('button4');

        button3.addEventListener('click', function() {
            button4.classList.toggle('hidden');
        });
    </script>
    </body>
</html>