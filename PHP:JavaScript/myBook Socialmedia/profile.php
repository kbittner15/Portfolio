<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');


if (isset($_GET['username'])) {
        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {

                $username = DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
                $userdescription = DB::query('SELECT UserDescription FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['UserDescription'];
                $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
                $followerid = Login::isLoggedIn();

                if (isset($_POST['follow'])) {

                        if ($userid != $followerid) {

                                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                       
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
                      
                                Post::createPost($_POST['postbody'], Login::isLoggedIn(), $userid);
                        
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
        <div class="container"><a class="navbar-brand" href="index.html">MyBook</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html">Home&nbsp;</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="allposts.html">All Posts</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="popularday.html">Popular</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="people.html">People</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group" style="margin-right: 37px;"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" id="search-field" name="search"></div>
                </form>
                <div class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color: rgb(0,0,0);">User&nbsp;</a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="profile.php?username=<?php echo $username ?>">My Profile</a><a class="dropdown-item" role="presentation" href="logout.php">Logout</a></div>
                </div>
            </div>
        </div>
    </nav>
    <h1 style="margin-right: 0px;margin-left: 31px;"><?php echo $username; ?>'s Profile</h1>
    <?php if ($userid != $followerid) {
                if ($isFollowing) {
                        echo '<input type="submit" name="unfollow" value="Unfollow">';
                } else {
                        echo '<input type="submit" name="follow" value="Follow">';
                }
        }
        ?>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="margin-top: 27px;">
                    <h1>Description</h1>
                    <p><?php echo $userdescription; ?></p>
                </div>
                <div class="col-md-6" style="margin-top: 27px;"><button class="btn btn-primary" type="button" style="height: 53px;width: 514px;margin-left: 0px;margin-bottom: 12px;margin-top: 10px;" onclick="showNewPostModal()">New Post</button>
                <div class = "timelineposts">
                
        
               </div>    
                
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newpost" role="dialog" tabindex="-1" style="padding-top:100px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title">New Post</h4></div>
                <div style="max-height: 400px; overflow-y: auto">
                        <form action="profile.php?username=<?php echo $username; ?>" method="post" enctype="multipart/form-data">
                                <textarea name="postbody" rows="8" cols="80"></textarea>
                         

                </div>
                <div class="modal-footer">
                <select name="public" id="public">
                 <option value="public">Public</option>
                  <option value="private">Private</option>
                 </select>
                    <input type="submit" name="post" value="Post" class="btn btn-default" type="button" style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script type="text/javascript">
      

        
          $(document).ready(function() {
                  $.ajax({
  
                        type: "GET",
                                    url: "api/profileposts?username=<?php echo $username; ?>",
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                          success: function(r) {
                                var posts = JSON.parse(r)
                             $.each(posts, function(index){
                                      $('.timelineposts').html(
                                           $('.timelineposts').html() + 
                                         '<blockquote class="blockquote border rounded shadow" style="width: 518px;margin-left: 0px;"><p class="mb-0">'+posts[index].PostBody+'</p><footer class="blockquote-footer" style="margin-top: 80px;">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn" data-id="'+posts[index].PostId+'" type="button" style="margin-left: 50px;background-color: rgba(0,123,255,0);color: rgb(255,0,0);"><i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp; '+posts[index].UpVotes+' UpVotes</button></footer></blockquote>'
                                            
                                            
                                            
                                          )
                                        
                                        
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
                                                             $("[data-id='"+buttonid+"']").html('<i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp;<span> '+res.UpVotes+' UpVotes</span>')
                                                             console.log(r)
                                                          },
                                                          error: function(r) {
                                                                  console.log(r)
                                                          }
  
                                                  });
                                          })
                                 // })
                                },
                                
                          error: function(r) {
                                  console.log(r)
                          }
  
                  });
  
          });
          function showNewPostModal() {
                $('#newpost').modal('show')
        }
  
        
      </script>
</body>

</html>
