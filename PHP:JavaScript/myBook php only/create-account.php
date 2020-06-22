
<?php
include('classes/DB.php');
include('classes/Mail.php');

if (isset($_POST['createaccount'])) {

        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $username = $_POST['username'];
        $UserDescription = $_POST['UserDescription'];
        $Birthday = $_POST['Birthday'];
        $Country = $_POST['Country'];
        $Email = $_POST['Email'];
        $UserPass = $_POST['UserPass'];
        $verified = '0';
        
        if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
               
                if (strlen($username) >= 3 && strlen($username) <= 32) {
                     
                        if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                              
                                if (!DB::query('SELECT Email FROM users WHERE Email=:Email', array(':Email'=>$Email))) {

                                if (strlen($UserPass) >= 6 && strlen($UserPass) <= 60) {
                                      
                                        if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {


                                         DB::query('INSERT INTO users VALUES (null,:username, :FirstName, :LastName, :UserDescription, :UserPass, :Email, :Country, :Birthday, :verified, null)', array(':username'=>$username, ':FirstName'=>$FirstName, ':LastName'=>$LastName, ':UserDescription'=>$UserDescription, ':UserPass'=>password_hash($UserPass, PASSWORD_BCRYPT), ':Email'=>$Email, ':Country'=>$Country, ':Birthday'=>$Birthday, 'verified'=>$verified));
                                         Mail::sendMail('Welcome to MyBook!', 'Your account has been created!', $Email);
                                         echo "Success!";

                                         } else {
                                         echo 'Invalid Email!';
                                         }
                                } else {
                                 echo 'Invalid password!';
                                 }
                        } else {
                        echo 'Email Already exsist';
                        }
                } else {
                echo 'Invalid username';
                }

                 } else {
                echo 'Invalid username!';
                }
        } else {
        echo 'User already exists!';
        }
}

?>
             
             
           
                <h1>Register</h1>
                <form action="create-account.php" method="post">
                <label for="firstname">Firstname:</label>
		 <input type="text" id="firstname" name="FirstName" required ><br><br>
		<label for="lastname">Lastname:</label>
		 <input type="text" id="lastname" name="LastName" required><br><br>
                 <label for="username">username:</label>
		 <input type="text" id="username" name="username" required><br><br>
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
                  <input type="submit" name="createaccount" value="Create Account">
</form>
