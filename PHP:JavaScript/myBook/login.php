
<?php
include('classes/DB.php');

if (isset($_POST['login'])) {
        $Email = $_POST['Email'];
        $UserPass = $_POST['UserPass'];

        if (DB::query('SELECT Email FROM users WHERE Email=:Email', array(':Email'=>$Email))) {
                
                if (password_verify($UserPass, DB::query('SELECT UserPass FROM users WHERE Email=:Email', array(':Email'=>$Email))[0]['UserPass'])) {
                 echo 'Logged in!';
                 $VTrue = True;
                 $Token = bin2hex(openssl_random_pseudo_bytes(64, $VTrue));
                 $User_ID = DB::query('SELECT id FROM users WHERE Email=:Email', array(':Email'=>$Email))[0]['id'];
                 DB::query('INSERT INTO Login_Tokens VALUES (NULL, :Token, :User_ID)', array(':Token'=>sha1($Token), ':User_ID'=>$User_ID));

                 setcookie("MyBookCookie", $Token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                 header("Location: http://localhost:8888/index.php");


                } else {
                        echo 'Incorrect Password!';
                }

        } else {
                echo 'User not registered!';
        }

}

?>

<h1>Login to your account</h1>
<form action="login.php" method="post">
<input type="text" name="Email" value="" placeholder="Email ..."><p />
<input type="password" name="UserPass" value="" placeholder="Password ..."><p />
<input type="submit" name="login" value="Create Account">
<input type="submit" name="login" value="Login">
</form>
