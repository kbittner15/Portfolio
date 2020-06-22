

<head>
	<title>New Account</title>
	<link rel="stylesheet" href="assets/Styles.css">
	<meta charset = "UTF-8" name="viewport" content="width=device-width, initial-scale=1">
		
</head>
<main>
<body>
		
	<div id = "NewAccount"></div>
	
	<form action = "includes/signup.inc.php" method = "POST" >
		<label for="firstname">Firstname:</label>
		 <input type="text" id="firstname" name="FirstName" required ><br><br>
		<label for="lastname">Lastname:</label>
		 <input type="text" id="lastname" name="LastName" required><br><br>
		 <label for="UserDescription">Description:</label>
		 <input type="text" id="UserDescription" name="UserDescription" required><br><br>
		 <label for="Country">Country:</label>
		 <input type="text" id="Country" name="Country" required><br><br>
		 <label for="Birthday">Birthday:</label>
		 <input type="date" id="Birthday" name="Birthday" required><br><br>
		<label for="email">Email:</label>
		 <input type="text" id="email" name="Email" required><br><br>
		 <label for="password">Password:</label>
  		<input type="text" id="password" name="UserPass" required><br><br>
		<input type = "submit" name = "signup-submit">Signup</input>
			 </form>
			 
	</div>
</body>
</main>