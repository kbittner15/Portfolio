<?php

session_start();

if (isset($_POST['login-submit'])){
    require 'dbh.inc.php';
    
$Email = $_POST['Email'];
$Pass = $_POST['Pass'];


$stmtE = $conn->prepare("SELECT Email FROM Users WHERE Email = ?");
$stmtE->bind_param('s', $Email);
$stmtE->execute();
$resultE = $stmtE->get_result();


$stmtP = $conn->prepare("SELECT Pass FROM Users WHERE Pass = ?");
$stmtP->bind_param('s', $Pass);
$stmtP->execute();
$resultP = $stmtP->get_result();


if(mysqli_num_rows($resultE)==1 && mysqli_num_rows($resultP)==1 ){
$_SESSION['Email'] = $Email;
echo "<script>window.open('homepage.php', '_self')</script>";
exit();
}
else{
echo"Failure login";
exit();
}
}