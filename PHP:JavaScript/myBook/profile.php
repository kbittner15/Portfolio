<head>
<link rel="stylesheet" type="text/css" href="Style/FormStyle.css">
</head>

<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notifications.php');

$username = "";
$verified = False;
$isFollowing = False;
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
                                        DB::query('INSERT INTO followers VALUES (null, :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
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
                        if($_FILES['postimg']['size'] == 0){
                    Post::createPost($_POST['postbody'], Login::isLoggedIn(), $userid);
                }else{
                        $postid = Post::createImgPost($_POST['postbody'], Login::isLoggedIn(), $userid);
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

?>







<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>mybook</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md border rounded-0 navigation-clean-search">
        <div class="container"><a class="navbar-brand" href="localhost:8888/index.html">MyBook</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="localhost:8888/index.html">Home&nbsp;</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="localhost:8888/allposts.php">All Posts</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="localhost:8888/popular.php">Popular</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="localhost:8888/people.php">People</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group" style="margin-right: 37px;"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" id="search-field" name="search"></div>
                </form>
                <div class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(0,0,0);">User&nbsp;</a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="localhost:8888/profile.html">My Profile</a><a class="dropdown-item" role="presentation" href="localhost:8888/messages.php">Messages</a><a class="dropdown-item" role="presentation" href="localhost:8888/notifications.php">Notifications</a><a class="dropdown-item" role="presentation"
                            href="localhost:8888/logout.php">Logout</a></div>
                </div>
            </div>
        </div>
    </nav>
    <h1 style="margin-right: 0px;margin-left: 31px;"><?php echo $username; ?>'s Profile <?php if($verified) { echo '<i class="fa fa-star"></i>';}?></h1>
    <div class="container border rounded" style="height: 148px;width: 570px;margin-left: 220px;">
        <h1>Description</h1>
        <p>wefljwfnwfnwrfwknrfwjrknfwrkfnwrf.nwrkfnwrjfnwrfnwrjfwkrnfkwr&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;adjcfnrncfwrkwnrcw&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;kljrelfkrfnefnerfkerjnfejkfnekfnerkfj</p>
    </div><button class="btn btn-primary" type="button" style="height: 53px;width: 569px;margin-left: 222px;margin-bottom: 12px;margin-top: 10px;" onclick="showNewPostModal">New Post</button>
    <div class = "timelineposts">
   
   </div>
   <div class="modal fade" id ="commentsmodel" role="dialog" tabindex="-1" style="/*opacity: 1;*//*display: inline-block;*/">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Comments</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <p>The content of your modal.</p>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
<div class="modal fade" id ="newpost" role="dialog" tabindex="-1" style="/*opacity: 1;*//*display: inline-block;*/">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Posts</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div  style="max-height: 400px; overflow-y: auto;">
            <form action="profile.php?username=<?php echo $username; ?>" method="post" enctype="multipart/form-data">
        <textarea name="postbody" rows="8" cols="80"></textarea>
        <textarea name="Public?" rows="8" cols="2"></textarea>
        <br/>Upload an Image:
        <input type="file" name="postimg">
       

            </div>
            <div class="modal-footer">
            <input type="submit" name="post" value="Post" class="btn btn-primary" type="button" style="height: 53px;margin-left: 222px;margin-bottom: 12px;margin-top: 10px;">    
            <button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
            </form>
        </div>
    </div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script type="text/javascript">
function scrollToAnchor(aid){
    var aTag = $(aid);
        $('html,body').animate({scrollTop: aTag.offset().top},'slow');
    }
        $(document).ready(function() {
                $.ajax({

                        type: "GET",
                        url: "api/profileposts?username=<?php echo $username; ?>",
                        processData: false,
                        contentType: "application/json",
                        data: '',
                        success: function(r) {
                                var posts = JSON.parse(r)
                                $.each(posts, function(index) {

                                        if(posts[index].PostImage==""){

                                        

                                        $('.timelineposts').html(
                                                $('.timelineposts').html() +
                                                ' <div class="container" style="height: 148px;width: 570px;"> <blockquote class="blockquote border rounded shadow" style="width: 570px;margin-left: 0px;"><p class="mb-0">'+posts[index].PostBody+'</p><footer class="blockquote-footer" style="margin-top: 80px;">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn" data-id="'+posts[index].PostId+'" type="button" style="margin-left: 50px;background-color: rgba(0,123,255,0);color: rgb(255,0,0);"><i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp; '+posts[index].UpVotes+' UpVotes</button><buttonclass="btn" type="button" data-postid="'+posts[index].PostId+'" style="margin-left: 20px;color: rgb(8,76,156);"><i class="fa fa-align-left"></i>&nbsp; Comments</button></footer></blockquote></div>'

                                        )
                                        }else{
                                                  

                                        $('.timelineposts').html(
                                                $('.timelineposts').html() +
                                                ' <div class="container" style="height: 148px;width: 570px;"> <blockquote class="blockquote border rounded shadow" style="width: 570px;margin-left: 0px;"><p class="mb-0">'+posts[index].PostBody+'</p><img scr="" data-tempsrc="'+posts[index].PostImage+'" class= "postimg" id="img'+post[index].postId+'"><footer class="blockquote-footer" style="margin-top: 80px;">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn" data-id="'+posts[index].PostId+'" type="button" style="margin-left: 50px;background-color: rgba(0,123,255,0);color: rgb(255,0,0);"><i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp; '+posts[index].UpVotes+' UpVotes</button><buttonclass="btn" type="button" data-postid="'+posts[index].PostId+'" style="margin-left: 20px;color: rgb(8,76,156);"><i class="fa fa-align-left"></i>&nbsp; Comments</button></footer></blockquote></div>'

                                        )

                                        }

                                        $('[data-postid]').click(function() {
                                                var buttonid = $(this).attr('data-postid');

                                                $.ajax({

                                                        type: "GET",
                                                        url: "api/comments?postid=" + $(this).attr('data-postid'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r) {
                                                                var res = JSON.parse(r)
                                                                showCommentsModal(res);
                                                        },
                                                        error: function(r) {
                                                                console.log(r)
                                                        }

                                                });
                                        });

                                        $('[data-id]').click(function() {
                                                var buttonid = $(this).attr('data-id');
                                                $.ajax({

                                                        type: "POST",
                                                        url: "api/upvotes?id=" + $(this).attr('data-id'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r) {
                                                                var res = JSON.parse(r)
                                                                $("[data-id='"+buttonid+"']").html(' <i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp '+res.UpVotes+' upvotes</span>')
                                                        },
                                                        error: function(r) {
                                                                console.log(r)
                                                        }

                                                });
                                        })
                                })
                                $('.postimg').each(function() {
                                        this.src=$(this).attr('data-tempsrc')
                                        this.onload = function() {
                                                this.style.opacity = '1';
                                        }
                                })
                                scrollToAnchor(location.hash)
                        },
                        error: function(r) {
                                console.log(r)
                        }

                });

        });

        function showNewPostModal() {
                $('#newpost').modal('show')
        }

        function showCommentsModal(res) {
                $('#commentsmodel').modal('show')
                var output = "";
                for (var i = 0; i < res.length; i++) {
                        output += res[i].Comment;
                        output += " ~ ";
                        output += res[i].CommentedBy;
                        output += "<hr />";
                }

                $('.modal-body').html(output)
        }

    </script>
</body>

</html>