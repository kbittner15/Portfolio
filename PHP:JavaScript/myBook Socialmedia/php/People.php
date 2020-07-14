<head>
<link rel="stylesheet" type="text/css" href="Style/FormStyle.css">
</head>

<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Image.php');


    $query = DB::query("SELECT users.username, users.FirstName, users.LastName FROM users", array(':username'=>$username, ':FirstName'=>$FirstName, ':LastName'=>$LastName)); 
  
    foreach($query as $people) {

        echo $people['username']." ~ ".$people['FirstName']." ~ ".$people['LastName']."~";
        echo "<br>";

    }

  
 