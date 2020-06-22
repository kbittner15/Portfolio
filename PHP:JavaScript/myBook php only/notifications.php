<head>
<link rel="stylesheet" type="text/css" href="Style/FormStyle.css">
<link rel="stylesheet" type="text/css" href="Style/topbar.css">
</head>
<body>
<div class="topnav">
<a href="localhost:8888/my-account.php">My Account</a>
<a  href="localhost:8888/index.php">Home</a>
 <a href="localhost:8888/now.php">Now</a>
  <a href="localhost:8888/popular.php">Popular</a>
  <a  href="localhost:8888/People.php">People</a>
  <a class="active" href="localhost:8888/notifications.php">notifications</a>
  <a href="localhost:8888/my-messages.php">Messages</a>
  <a href="localhost:8888/logout.php">Sign-Out</a>
  </div>
  <h1>notifications</h1>

  <?php

include('./classes/DB.php');
include('./classes/Login.php');

if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        echo 'Not logged in';
}
echo "<h1>Notifcations</h1>";
if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$userid))) {

        $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY id DESC', array(':userid'=>$userid));

        foreach($notifications as $n) {

                if ($n['type'] == 1) {
                        $senderName = DB::query('SELECT username FROM users WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];

                        if ($n['extra'] == "") {
                                echo "You got a notification!<hr />";
                        } else {
                                $extra = json_decode($n['extra']);

                                echo $senderName." mentioned you in a post! - ".$extra->postbody."<hr />";
                        }

                } else if ($n['type'] == 2) {
                        $senderName = DB::query('SELECT username FROM users WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
                        echo $senderName." upvoted your post!<hr />";
                }

        }

}


?>
</body>