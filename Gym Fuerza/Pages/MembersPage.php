<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Members.css">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/5c4881a1fc.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    include("Header.php");
    ?>

    <?php
    include("../PHP/tblMembers.php");
    ?>
    <!--
        <div id="buttons">
            <br>
            <br>
            <button id="btnAdd" onclick=Add()>
                ADD
            </button>
        </div>
    -->
        <div id="modalEdit">
            <form id="formEdit" action="../PHP/edit.php" method="POST">
                <label for="Name">Name:</label>
                <input type="hidden" name="id" id="id">
                <input type="text" name="Name" id="Name">
                <div id="close">
                    <button id="btnClose" Value="X"onclick="closeEdit()">
                        X
                    </button>
                </div>
                <br>
                <br>
                <label for="M_Type">Membership Type:</label>
                <select name="M_Type" id="Membership">
                    <option value="Non-Member">Non-Member</option>
                    <option value="Member">Member</option>
                </select>
                <br>
                <br>
                <label for="D_Type">Discount Type:</label>
                <select name="D_Type" id="Discount">
                    <option value="Students">Student</option>
                    <option value="Regulars">Regular</option>
                </select>
                <br>
                <br>
                <input type="submit" value="Save" id="submit">
            </form>
        </div>

        <div id="modalAdd">
            <form action="">
                <label for="NameAdd">Name:</label>
                <input type="text" name="NameAdd" id="NameAdd">
                <div id="close">
                    <button id="btnCloseAdd" Value="X" onclick=closeAdd()>
                        X
                    </button>
                </div>
                <br>
                <label for="D_TypeAdd">Discount Type:</label>
                <select name="D_TypeAdd" id="DiscountAdd">
                <option value="Students">Student</option>
                <option value="Regulars">Regular</option>
                </select>
                <input type="submit" value="Save" id="submit" onclick=closeAdd()>
            </form>
        </div>
    </div>

    <script>
        var id = 0;
        const formDiv = document.getElementById("modalEdit");
        const formEdit = document.getElementById("formEdit");


        function Edit(e) {
            formDiv.style.display = "block";   

            const edit_btn = document.querySelector('#btnEdit');

            var parent = e.target.parentElement;

            if(e.target.tagName === 'I') {
                parent = e.target.parentElement.parentElement;
            }

            const name = parent.previousSibling.textContent;

            document.querySelector('#Name').value = name;


            id = parseInt(parent.previousSibling.getAttribute('id'));
            document.getElementById("id").value = id;
        }

        function closeEdit(e) {
            e.preventDefault();
            var Name = document.getElementById("Name").value;
            var Membership = document.getElementById("Membership").value;
            var Discount = document.getElementById("Discount").value;
            var id = document.getElementById("id").value;


            console.log(Name, Membership, Discount, id);
        }
        
        function Add() {
            document.getElementById("modalAdd").style.display = "block";   
        }

        function closeAdd() {
            document.getElementById("modalAdd").style.display = "none";   
        }
        
    </script>
</body>
</html>