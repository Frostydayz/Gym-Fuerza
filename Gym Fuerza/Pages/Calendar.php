<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/Calendar.css">
        <script>
            

        </script>

    </head>
    
    <body>
        <?php
            include("Header.php");
        ?>
    <div id="Calendar">
        <div id="CalendarNav">
            <div id="Sales">
                <button id="ViewSales" value="View">View Sales</button>
                <button id="BackButton" value="Back">Back</button>
            </div>
        </div>

        <div id="CalendarBody">
            <div id="Yearly">
            </div>
            <div id="Monthly">
            </div>
        </div>
    </div>

    <script>

        // Functionality for Buttons
        const button3 = document.getElementById('ViewSales');
        const button4 = document.getElementById('BackButton');

        // View the Button *Needs Functionality*
        button3.addEventListener('click', function() {
            button4.style.visibility = 'visible';
        });

        // Hide the Button *Needs Functionality*
        button4.addEventListener('click', function() {
            button4.style.visibility = 'hidden';
        }); 


        function displayYearGrid() {
            const yearGrid = document.getElementById('Yearly');

            // Start From This Year
            const currentYear = new Date().getFullYear();
            let startYear = currentYear - 2; 
            const yearsPerGrid = 4; 

            // Loop for Generation
            for (let i = 0; i < yearsPerGrid; i++) {
                const yearDiv = document.createElement('div');
                yearDiv.classList.add('year');
                yearDiv.textContent = startYear + i;
                yearGrid.appendChild(yearDiv);
            }
        }

        // Call Function
        displayYearGrid();

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

        function LoadMonthlyCalendar() {
            const monthGrid = document.getElementById('Monthly');
                
            // Loop and Create Months in Divs
                
            for (let i = 0; i < monthNames.length; i++) {
                const monthName = monthNames[i];
                const monthDiv = document.createElement('div');
                monthDiv.classList.add('month');
                monthDiv.textContent = monthName;
                monthGrid.appendChild(monthDiv);
            }
        }

        // Call Function
        LoadMonthlyCalendar();

    </script>
    </body>
</html>