

<head>
	<title>Login</title>
	<link rel="stylesheet" href="assets/Styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
</head>


<body>
		
	<div id = "loginForm">
	<p id = "loginText">MyBook Login</p>

	<form action = "includes/Login.inc.php" method = "POST">
		<label for="Email">Email:</label>
		 <input type="email" id="Email" name="Email" required><br><br>
		 <label for="password">Password:</label>
  		<input type="text" id="Password" name="Pass" required><br><br>
	  	 <a href="NewAccount.html">Create Account</a>
           <button type = "submit" name = "login-submit">Login</button>

	 			</form>
	</div>
</body>
