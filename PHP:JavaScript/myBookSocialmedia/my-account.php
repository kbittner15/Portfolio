<head>
<link rel="stylesheet" type="text/css" href="Style/FormStyle.css">
</head>


<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        die('Not logged in!');
}


?>
<h1>My Account</h1>
<form action="my-account.php" method="post" enctype="multipart/form-data">
       
        
</form>
