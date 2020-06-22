<?php
include("includes/dbh.inc.php");
?>

<nav class = "navbar navbar-default">
    <div class = "container-fluid">
        <div class = "navbar-header">
            <button type ="button" class= "navbar-toggle collapsed" data-toggle="collapse"
            aria-expanded="false"></button>
            <span class="sr-only">Toggle navigation></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <a href = "home.php" class="navbar-brand">MyBook</a>
        </div>
        <div class = "collapse navbar-collapse">
        <ul class = "nav navbar-nav">
            <?php
            $user = $_SESSION['Email'];
            $getUser = "SELECT * FROM users WHERE Email='$user'";
            $runUser = mysqli_query($conn, $getUser);
            $row = mysli_fetch_array($runUser);

            $ID = $row['ID'];
            $FirstName = $row['Firstname'];
            $LastName = $row['LastName'];
            $Gender = $row['Gender'];
            $Birthday = $row['Birthday'];
            $Email = $row['Email'];
            $Pass = $row['Pass'];

            $UPosts = "SELECT * FROM Posts WHERE ID='$ID'";
            $runPosts  = mysqli_query($conn, $UPosts);
            $Posts = mysqli_num_rows($runPosts);
            ?>
                <li><a href='profile.php?<?php echo "uID=$ID" ?>'>
                <?php echo "$FirstName"; ?></li>
                <li><a href='HomePage.php'>Home</a></li>
                <li><a href='People.php'>People</a></li>
                <li><a href='Messages.php?uID=new'>Messages</a></li>
                <?php
                echo"
                <li class = 'dropdown'>
                <a href ='#' class ='dropdown-toggle' data-toggle='dropdown'
                role='button' area-haspopup='true' area-expanded='false'>
                <span class = 'glyphicon glyphicon-chevron-down'></span></a>
                <ul class='dropdown-menu'>
                <li>
                <a href = 'myPosts.php?uID=$ID'> MY POSTS <span class= 'badge badge-secandary'> $Posts</span></a>
                </li>
                <li>
                    <a href = 'editProfile.php?uID=$ID'> Edit Profile</a>
                </li>
                <li role='seperator' class='divider'></li>
                <li>
                    <a href='logout.php'>Logout</a>
                </li>
                </ul>
                </li>
                
                ";
                ?>

        </ul>
       
            <ul class = "nav nabar-nav navbar-right">
                <li class = "dropdown">
                    <form class = "navbar-form navbar-left" method = "get" action="results.php">
                        <div class= "form-group">
                        <input class = "form-control" type= "text" name = "UQuery"
                        placeholder= "Search ">
                        </div>
                    <button type= "submit" class ="btn btn-info" name = "search">Search
                    </button>
                    </form>
                </li>
          </ul>
        </div>
    </div>
</nab>
