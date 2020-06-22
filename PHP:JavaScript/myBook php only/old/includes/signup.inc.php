<?php
if (isset($_POST['signup-submit'])){
    require 'dbh.inc.php';

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$UserDescription = $_POST['UserDescription'];
$Birthday = $_POST['Birthday'];
$Country = $_POST['Country'];
$Email = $_POST['Email'];
$UserPass = $_POST['UserPass'];
$UserStatus = "verified";
$Posts = "no";
$UserImage = "no";
$CoverImage= "no";





$stmt = $conn->prepare("SELECT Email FROM Users WHERE Email = ?");
$stmt->bind_param('s', $Email);
$stmt->execute();
$result = $stmt->get_result();


if (mysqli_num_rows($result) > 0) {
    echo "Email Taken";
}else{
    $sql = "INSERT INTO users (FirstName, LastName, UserDescription, Birthday, Country, UserImage, CoverImage, Email, UserPass, UserStatus, Posts, UserRegDate)
    VALUES ('$FirstName', '$LastName', '$UserDescription', '$Birthday', '$Country' ,'$UserImage','$CoverImage','$Email', '$UserPass', '$UserStatus', '$Posts', NOW())";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

}