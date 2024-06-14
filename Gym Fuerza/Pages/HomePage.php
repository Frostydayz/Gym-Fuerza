<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/HomePage.css">
    <script>
        function showD_Type() {
            document.getElementById("Discount").style.visibility = "visible";
        }

        function validateForm() {
            var memberChecked = document.querySelector('input[name="M_Type"]:checked');
            
            if (!memberChecked) {
                alert("Please select Membership Type and Citizenship Status");
                return false;
            }
        }

        function reloadPage() {
        location.reload();
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("QuickAccessForm").addEventListener("submit", function(event) {
                event.preventDefault();

                console.log("Form submitted via AJAX");
                
                var formData = new FormData(this);
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText;
                            if (response === "user_exists") {
                                alert("User with this name already exists.");
                            } else {
                                alert("Data successfully inserted.");
                                reloadPage();
                            }
                        } else {
                            alert("Error: " + xhr.status);
                        }
                    }
                };  

                xhr.open("POST", "../PHP/search.php");
                xhr.send(formData);
            });
        });
    </script>
    </head>
    <body>
    <?php
        include("Header.php");
    ?>
        <div id="Body">
            <div id="EntryForm">
                <form action="../PHP/search.PHP" method="POST" id="QuickAccessForm" onsubmit="return validateForm(); event.preventDefault(); ">

                    
                    <input type="radio" id="Member" name="M_Type" value="Members" onclick="showD_Type()">
                    <label for="Member">Member</label>
                    <input type="radio" id="NonMember" name="M_Type" value="NonMembers" onclick="showD_Type()"  >
                    <label for="Non-Member">Non-Member</label>

                    
                    <input type="search" name="searchbar" placeholder="Input Name" id="searchbar" required>
                    <div id="SuggestionBox"></div>

                    
                    <select name="D_Type" id="Discount" oninput="">
                        <option value="Students">Student</option>
                        <option value="Regulars">Regular</option>
                    </select>

                    
                    <input type="submit" value="Submit" id="submit">
                </form>

                <form id="startDay" action="../PHP/startDay.php" method="post">
                    <button type="button" id="confirmButton">Start New Day</button>    
                    <button type="submit" id="submitButton" style="display: none;">Submit Data</button>
               </form>
            </div>
            <div id="Logs">
                <table id="tblLogs">
                    <?php
                        include("../PHP/DisplayTable.php");
                    ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </body>

    <script>
            document.getElementById("confirmButton").addEventListener("click", function() {
            var confirmed = confirm("Are you sure you want to Start a new Day?");
            if (confirmed) {
            document.getElementById("submitButton").click();
            }
        });

    </script>
</html>
