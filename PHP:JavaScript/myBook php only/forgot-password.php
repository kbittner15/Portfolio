<head>
<link rel="stylesheet" type="text/css" href="Style/FormStyle.css">
</head>


<?php
include('./classes/DB.php');
include('./classes/Mail.php');

if (isset($_POST['resetpassword'])) {

        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        $Email = $_POST['Email'];
        $user_id = DB::query('SELECT id FROM users WHERE Email=:Email', array(':Email'=>$Email))[0]['id'];
        DB::query('INSERT INTO password_tokens VALUES (null, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
        Mail::sendMail('Forgot Password!', "<a href='http://localhost/tutorials/sn/change-password.php?token=$token'>http://localhost/tutorials/sn/change-password.php?token=$token</a>", $Email);
        echo 'Email sent!';
}

?>

<div class= "outer-container">
<div class="inner-container">
<h1>Forgot Password</h1>
<form action="forgot-password.php" method="post">
        <input type="text" name="Email" value="" placeholder="Email ..."><p />
        <input type="submit" name="resetpassword" value="Reset Password">
</form>
<div>
</div>
