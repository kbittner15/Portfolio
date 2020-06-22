 <?php

$servername = "127.0.0.1";
$dBUsername = "user";
$dBPassword = "12345678";
$dBName = "MyBook";

$conn = mysqli_connect($servername,$dBUsername, $dBPassword, $dBName );

if (!$conn){
    die("Connection Falure:".mysqli_connect_error());
}
