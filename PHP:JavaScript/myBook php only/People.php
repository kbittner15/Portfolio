<head>
<link rel="stylesheet" type="text/css" href="Style/FormStyle.css">
<link rel="stylesheet" type="text/css" href="Style/topbar.css">
</head>

<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');

$username = "";
$verified = False;
$isFollowing = False;
?>

<div class="topnav">
<a href="localhost:8888/my-account.php">My Account</a>
<a  href="localhost:8888/index.php">Home</a>
 <a href="localhost:8888/now.php">Now</a>
  <a href="localhost:8888/popular.php">Popular</a>
  <a class="active" href="localhost:8888/People.php">People</a>
  <a href="localhost:8888/notifications.php">notifications</a>
  <a href="localhost:8888/my-messages.php">Messages</a>
  <a href="localhost:8888/logout.php">Sign-Out</a>
  </div>
  <h1>People</h1>

  <?php

if (isset($_GET['username'])) {
    if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {

            $username = DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
            $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
            $verified = DB::query('SELECT verified FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['verified'];
            $followerid = Login::isLoggedIn();

            if (isset($_POST['follow'])) {

                    if ($userid != $followerid) {

                            if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                    if ($followerid == 6) {
                                            DB::query('UPDATE users SET verified=1 WHERE id=:userid', array(':userid'=>$userid));
                                    }
                                    DB::query('INSERT INTO followers VALUES (\'\', :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                            } else {
                                    echo 'Already following!';
                            }
                            $isFollowing = True;
                    }
            }
            if (isset($_POST['unfollow'])) {

                    if ($userid != $followerid) {

                            if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                    if ($followerid == 6) {
                                            DB::query('UPDATE users SET verified=0 WHERE id=:userid', array(':userid'=>$userid));
                                    }
                                    DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                            }
                            $isFollowing = False;
                    }
            }
            if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                    //echo 'Already following!';
                    $isFollowing = True;
            }

            if (isset($_POST['deletepost'])) {
                    if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid))) {
                            DB::query('DELETE FROM posts WHERE id=:postid and user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid));
                            DB::query('DELETE FROM post_upvotes WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
                            echo 'Post deleted!';
                    }
            }


            if (isset($_POST['post'])) {
                    if ($_FILES['postimg']['size'] == 0) {
                            Post::createPost($_POST['postbody'], Login::isLoggedIn(), $userid, $_POST['postbody']);
                    } else {
                            $postid = Post::createImgPost($_POST['postbody'], Login::isLoggedIn(), $userid, $_POST['postbody']);
                            Image::uploadImage('postimg', "UPDATE posts SET postimg=:postimg WHERE id=:postid", array(':postid'=>$postid));
                    }
            }

            if (isset($_GET['postid']) && !isset($_POST['deletepost'])) {
                    Post::upvotePost($_GET['postid'], $followerid);
            }

            $posts = Post::displayPosts($userid, $username, $followerid);


    } else {
            die('User not found!');
    }
}



    $query = DB::query("SELECT users.username, users.FirstName, users.LastName FROM users", array(':username'=>$username, ':FirstName'=>$FirstName, ':LastName'=>$LastName)); 
  
    foreach($query as $people) {

        if ($isFollowing) {
            echo $people['username']." ~ ".$people['FirstName']." ~ ".$people['LastName']."~";
            echo "<form action='People.php?postid=".$people['username']."' method='post'>";
            echo '<input type="submit" name="unfollow" value="Unfollow">';
    } else {
        echo $people['username']." ~ ".$people['FirstName']." ~ ".$people['LastName']."~";
        echo "<form action='People.php?postid=".$people['username']."' method='post'>";    
        echo '<input type="submit" name="follow" value="Follow">';
    }


        
       
    }

  
    
 