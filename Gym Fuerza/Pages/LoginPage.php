<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Login page</title>
		<link rel="stylesheet" href="Login.css">

	</head>
	<body>
		<div id="Login">
			<div id="LoginInner">
				<img src="../Images/Logo.png" id="Logo">
				<h1>Welcome Back</h1>				
				<form method="get">
					<p>Email Adress*</p>
					<input type="text" id="Email" placeholder="Enter Email" required>
					<p>Password*</p>	
					<input type="text" id="Password" placeholder="Enter Password" name="Password" required>
					<br>
					<br>
					<input type="Submit" id="Submit" value="Login" onclick="login()">	
					<hr>
				</form>
			</div>
		</div>	
	</body>

	
	<script>

	function login(){
		
	var Email = document.getElementById("Email").value;
	var Password = document.getElementById("Password").value;
		if((Email == "a")&&(Password == "a")){
		window.alert("Correct");
		open = window.open("HomePage.php");
		open.close();
	}
		else {
			window.alert("Incorrect Username or Password");
		}
	}
</script>
</html>