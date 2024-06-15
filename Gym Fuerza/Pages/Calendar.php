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
            <div id="Yearly"><!-- Yearly Content Here --></div>
            <div id="Monthly"><!-- Monthly Content Here --></div>
            <div id="Daily">
                <div class="DailyHeader">
                    <div class="MonthYear" id="MonthYear"></div>    
                </div>
                <div class="DaysBody">
                    <div class="Days">
                        <div class="Day">Sun</div>
                        <div class="Day">Mon</div>
                        <div class="Day">Tue</div>
                        <div class="Day">Wed</div>
                        <div class="Day">Thu</div>
                        <div class="Day">Fri</div>
                        <div class="Day">Sat</div>
                    </div>
                    <div class="Dates" id="Dates"></div> 
                </div>
            </div>
        </div>
    </div>

    <script>

        // Functionality for Buttons
        const button3 = document.getElementById('ViewSales');

        // View the Button *Needs Functionality*
        button3.addEventListener('click', function() {
            alert('No Functions Thus Far')
        });

        // Hide the Button *Needs Functionality*
        

        // Toggle Switch
        function toggleCalendarView() {
            const yearlyDiv = document.getElementById('Yearly');
            const monthlyDiv = document.getElementById('Monthly');
            const dailyDiv = document.getElementById('Daily');
            const backButton = document.getElementById('BackButton');

            if (yearlyDiv.style.opacity === "1" || yearlyDiv.style.opacity === "") {
                // if at Yearly View go to Monthly View
                yearlyDiv.style.opacity = "0";
                yearlyDiv.style.pointerEvents = "none";
                monthlyDiv.style.opacity = "1";
                monthlyDiv.style.pointerEvents = "all";
                dailyDiv.style.opacity = "0";
                dailyDiv.style.pointerEvents = "none";
                backButton.style.visibility = 'visible';

            } else if (monthlyDiv.style.opacity === "1") {
                // else if at Monthly View go to Daily View
                monthlyDiv.style.opacity = "0";
                monthlyDiv.style.pointerEvents = "none";
                dailyDiv.style.opacity = "1";
                dailyDiv.style.pointerEvents = "all";
                backButton.style.visibility = 'visible';

            } else {
                // else go to Yearly View
                yearlyDiv.style.opacity = "1";
                yearlyDiv.style.pointerEvents = "all";
                monthlyDiv.style.opacity = "0";
                monthlyDiv.style.pointerEvents = "none";
                dailyDiv.style.opacity = "0";
                dailyDiv.style.pointerEvents = "none";
            }
        }

        // Back Button Functionality
        const backButton = document.getElementById('BackButton');

        backButton.addEventListener('click', function() {
            const yearlyDiv = document.getElementById('Yearly');
            const monthlyDiv = document.getElementById('Monthly');
            const dailyDiv = document.getElementById('Daily');
            
            // if at Monthly View go to Yearly View
            if (monthlyDiv.style.opacity === "1") {
                yearlyDiv.style.opacity = "1";
                yearlyDiv.style.pointerEvents = "all";
                monthlyDiv.style.opacity = "0";
                monthlyDiv.style.pointerEvents = "none";
                dailyDiv.style.opacity = "0";
                dailyDiv.style.pointerEvents = "none";
                backButton.style.visibility = "hidden";

            // else if at Daily View go to Monthly View
            } else if (dailyDiv.style.opacity === "1") {
                yearlyDiv.style.opacity = "0";
                yearlyDiv.style.pointerEvents = "none";
                monthlyDiv.style.opacity = "1";
                monthlyDiv.style.pointerEvents = "all";
                dailyDiv.style.opacity = "0";
                dailyDiv.style.pointerEvents = "none";
                backButton.style.visibility = 'visible';

            // else go to Daily View
            } else {
                yearlyDiv.style.opacity = "0";
                yearlyDiv.style.pointerEvents = "none";
                monthlyDiv.style.opacity = "0";
                monthlyDiv.style.pointerEvents = "none";
                dailyDiv.style.opacity = "1";
                dailyDiv.style.pointerEvents = "all";
                backButton.style.visibility = 'visible';

            }
        });

        const yearGrid = document.getElementById('Yearly');

        // Start From This Year
        const currentYear = new Date().getFullYear();

        // Add or Minus for Dynamic Setup
        let startYear = currentYear /* Add Here + or - */ ;
        const yearsPerGrid = 4; 
        let selectedYear = currentYear;

        // Loop for Generation
        for (let i = 0; i < yearsPerGrid; i++) {
            const yearDiv = document.createElement('div');
            yearDiv.classList.add('Year');
            const year = startYear + i;
            yearDiv.textContent = startYear + i;

            yearDiv.addEventListener('click', function() {
                selectedYear = year;
                toggleCalendarView();
                updateCalendar();
            });

            yearGrid.appendChild(yearDiv);
        }


        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

        
        const monthGrid = document.getElementById('Monthly');
        monthGrid.innerHTML = ''
        let selectedMonth = new Date().getMonth();
                
        // Loop and Create Months in Divs
        for (let i = 0; i < monthNames.length; i++) {
            const monthName = monthNames[i];
            const monthDiv = document.createElement('div');
            monthDiv.classList.add('Month');
            monthDiv.textContent = monthName;

            monthDiv.addEventListener('click', function() {
                selectedMonth = i;
                toggleCalendarView();
                updateCalendar();
            });

            monthGrid.appendChild(monthDiv);
        }
        
        const monthYearElement = document.getElementById('MonthYear');
        const datesElement = document.getElementById('Dates');
            
        let currentDate = new Date();

        const updateCalendar = () => {
            currentDate = new Date(selectedYear, selectedMonth);
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth();

            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const totalDays = lastDay.getDate();
            const firstDayIndex = firstDay.getDay();
            const lastDayIndex = lastDay.getDay();

            const monthYearString = currentDate.toLocaleString('default', {month: 'long', year: 'numeric'});
            monthYearElement.textContent = monthYearString;

            let datesHTML = '';

            
            for(let i = firstDayIndex; i > 0; i--) {
                const prevDate = new Date(currentYear, currentMonth, 0 - i + 1);
                datesHTML += `<div class="Date inactive"></div>`;
            } 
            /* ${prevDate.getDate()} Insert This in between the Div for Before Month Numbers*/

            for(let i = 1; i <= totalDays; i++) {
                const date = new Date(currentYear, currentMonth, i);
                const activeClass = date.toDateString() === new Date().toDateString() ? 'active' : '';
                datesHTML += `<div class="Date ${activeClass}">${i}</div>`;
            }

            
            for(let i = 1; i <= 6 - lastDayIndex; i++) {
                const nextDate = new Date(currentYear, currentMonth + 1, i);
                datesHTML += `<div class="Date inactive"></div>`;
            }
            /* ${nextDate.getDate()} Insert This in between the Div for After Month Numbers */

            datesElement.innerHTML = datesHTML;
        }

        updateCalendar();
    </script>
    </body>
</html>