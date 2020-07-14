<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');


            $token = sha1($_COOKIE{'MyBookCookie'});
            
            $tokenid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$token))[0]['user_id'];
            
            $username = DB::query('SELECT username FROM users WHERE id=:tokenid', array(':tokenid'=>$tokenid))[0]['username'];

            
    
    
              
        
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
        <div class="container"><a class="navbar-brand" href="index.php">MyBook</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home&nbsp;</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="allposts.php">All Posts</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="popularday.php">Popular</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="people.php">People</a></li>
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
    <h1 style="margin-right: 0px;margin-left: 31px;">Popular</h1>
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container-fluid"><a class="navbar-brand" href="#">Times</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-2">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="popularday.php">Today</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="popularweek.php">This Week</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="popularmonth.php">This Month</a></li>
                </ul>
            </div>
        </div>
    </nav>
   <div class = "popularposts" >




   </div>
   
   
    
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script type="text/javascript">
      
       
        
          $(document).ready(function() {
                  $.ajax({
  
                          type: "GET",
                          url: "api/popularday",
                          processData: false,
                          contentType: "application/json",
                          data: '',
                          success: function(r) {
                              console.log(r)
                                var posts = JSON.parse(r)
                                $.each(posts, function(index) {
                                    console.log(posts)
                                    
  
                                      $('.popularposts').html(
                                       $('.popularposts').html() +
                                       '<div class="container" style="height: 148px;"><blockquote class="blockquote border rounded shadow"> <p class="mb-0">'+posts[index].PostBody+'</p><footer class="blockquote-footer" style="margin-top: 80px;">Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn" type="button" data-id="'+posts[index].PostId+'" style="margin-left: 50px;background-color: rgba(0,123,255,0);color: rgb(255,0,0);"><i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp; '+posts[index].UpVotes+' UpVotes</button></footer></blockquote> </div>'


                                            
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
                                                                  $("[data-id='"+buttonid+"']").html(' <i class="fa fa-arrow-up" data-bs-hover-animate="bounce"></i>&nbsp '+res.UpVotes+' upvotes</span>')
                                                          },
                                                          error: function(r) {
                                                                  console.log(r)
                                                          }
  
                                                  });
                                          })
                                  })
                                 
                                 
                          },
                          error: function(r) {
                                  console.log(r)
                          }
  
                  });
  
          });
  
         
      </script>
</body>

</html>