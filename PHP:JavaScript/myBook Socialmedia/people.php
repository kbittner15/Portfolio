

<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');


            $token = sha1($_COOKIE{'MyBookCookie'});
            
            $tokenid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$token))[0]['user_id'];
            
            $username2 = DB::query('SELECT username FROM users WHERE id=:tokenid', array(':tokenid'=>$tokenid))[0]['username'];

            
    
    
              
        
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
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="profile.php?username=<?php echo $username2; ?>">My Profile</a><a class="dropdown-item" role="presentation" href="logout.php">Logout</a></div>
                </div>
            </div>
        </div>
    </nav>
    <h1 style="margin-right: 0px;margin-left: 31px;">People</h1>
   
    <div class="peoples">

    </div>
    
   
    <div class="modal fade" role="dialog" tabindex="-1" style="/*opacity: 1;*//*display: inline-block;*/">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Title</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="modal-body">
                    <p>The content of your modal.</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
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
                        url: "api/peoplepage",
                        processData: false,
                        contentType: "application/json",
                        data: '',
                        success: function(r) {
                            console.log(r)
                             var users = JSON.parse(r)
                              $.each(users, function(index){
                                    $('.peoples').html(
                                        $('.peoples').html() + 
                                         '<a href="http://localhost:8888/profile.php?username='+users[index].username+'"><div class="container border rounded" style="height: 148px;"><h1 style="width: 900px;">'+users[index].FirstName+' '+users[index].LastName+'</h1><p style="width: 900px;">'+users[index].UserDescription+'</p><p>'+users[index].username+'</p></div></a>'
                                   )
                                 
                                      
                                 
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