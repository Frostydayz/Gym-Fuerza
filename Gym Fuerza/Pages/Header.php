    <script>
        function DisplayTime() {
            const dateTime = new Date();
            const hour = dateTime.getHours();
            const minute = dateTime.getMinutes();

            if (minute < 10) {
                document.getElementById("CurrentTime").innerHTML = hour + " : 0" + minute;
            } else {
                document.getElementById("CurrentTime").innerHTML = hour + " : " + minute;
            }
        }

        function GetTime() {
            const dateTime = new Date();
            const hour = dateTime.getHours();
            const minute = dateTime.getMinutes();

            if (minute < 10) {
                document.getElementById("Toime").innerHTML = hour + " : 0" + minute;
            } else {
                document.getElementById("Toime").innerHTML = hour + " : " + minute;
            }
        }

        function DisplayMonthDate() {
            const dateTime = new Date();
            const monthIndex = dateTime.getMonth();
            const monthName = getMonthName(monthIndex);
            const date = dateTime.getDate();

            document.getElementById("CurrentDate").innerHTML = monthName + " " + date;
        }

        function getMonthName(monthIndex) {
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            return monthNames[monthIndex];
        }

        function DisplayDay() {
            const dateTime = new Date();
            const DayNumber = dateTime.getDay();

            const DayName = [
            "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
            ];

            document.getElementById("CurrentDay").innerText = DayName[DayNumber];
        }

        window.onload = function() {
            DisplayDay();
            DisplayTime();
            DisplayMonthDate();
            
            setInterval(DisplayDay, 60000);
            setInterval(DisplayTime, 1000);
            setInterval(DisplayMonthDate, 60000);
        }
</script>

<div id="Header">
    <div id="LocaleTime">
        <div> 
            <p id="CurrentDay"></p>
        </div>
        <div class="TimeBox">
            <p id="CurrentTime"></p>
        </div>
        <div>
            <p id="CurrentDate"></p>
        </div>
    </div>
    <nav id="navbar">
        <a href ="HomePage.php">Homepage</a>
        <a href ="Calendar.php">Calendar</a>
        <a href ="MembersPage.php">Members</a>
        <a href ="">Sales</a>
    </nav>
</div>