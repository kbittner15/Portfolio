<?php
require_once("DB.php");
require_once("Mail.php");

$db = new DB("127.0.0.1", "MyBookData", "user", "12345678");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if ($_GET['url'] == "auth") {

        }else if ($_GET['url'] == "users") {

        }else if ($_GET['url'] == "posts") {

        $token = sha1($_COOKIE{'MyBookCookie'});
        
    
 
    
        $userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$token))[0]['user_id'];
    
       
         
        $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_time, posts.upvotes, users.`username` FROM users, posts, followers
        WHERE posts.user_id = followers.user_id
        AND users.id = posts.user_id
        AND follower_id = :userid
        ORDER BY posts.posted_time DESC;', array(':userid'=>$userid));
      
      $response = "[";
      foreach($followingposts as $post) {
              $response .= "{";
                      $response .= '"PostId": '.$post['id'].',';
                      $response .= '"PostBody": "'.$post['body'].'",';
                      $response .= '"PostedBy": "'.$post['username'].'",';
                      $response .= '"PostDate": "'.$post['posted_time'].'",';
                      $response .= '"UpVotes": '.$post['upvotes'].'';
              $response .= "},";


      }
      $response = substr($response, 0, strlen($response)-1);
      $response .= "]";

      http_response_code(200);
      echo $response;

     






                }else if ($_GET['url'] == "allposts") {

                $token = $_COOKIE['MyBookCookie'];
        
                $userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
                
                
                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_time, posts.upvotes, posts.public,  users.`username` FROM users, posts, followers
                WHERE posts.public="public"                
                ORDER BY posts.posted_time DESC;', array(':userid'=>$userid));
              
              $response = "[";
              foreach($followingposts as $post) {
        
                      $response .= "{";
                              $response .= '"PostId": '.$post['id'].',';
                              $response .= '"PostBody": "'.$post['body'].'",';
                              $response .= '"PostedBy": "'.$post['username'].'",';
                              $response .= '"PostDate": "'.$post['posted_time'].'",';
                              $response .= '"UpVotes": '.$post['upvotes'].'';
                      $response .= "},";
        
        
              }
              $response = substr($response, 0, strlen($response)-1);
              $response .= "]";
        
              http_response_code(200);
              echo $response;
        
        
        
        }else if ($_GET['url'] == "popularday") {

                $token = $_COOKIE['MyBookCookie'];
        
                $userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
                
                
                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_time, posts.upvotes, posts.upvotesdays, posts.public, users.`username` FROM users, posts, followers Where posts.public = "public"
                ORDER BY posts.upvotesdays DESC;', array(':userid'=>$userid));
              
              $response = "[";
              foreach($followingposts as $post) {
        
                      $response .= "{";
                              $response .= '"PostId": '.$post['id'].',';
                              $response .= '"PostBody": "'.$post['body'].'",';
                              $response .= '"PostedBy": "'.$post['username'].'",';
                              $response .= '"PostDate": "'.$post['posted_time'].'",';
                              $response .= '"UpVotes": '.$post['upvotes'].'';
                      $response .= "},";
        
        
              }
              $response = substr($response, 0, strlen($response)-1);
              $response .= "]";
        
              http_response_code(200);
              echo $response;
        
        
        }else if ($_GET['url'] == "popularweek") {

                $token = $_COOKIE['MyBookCookie'];
        
                $userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
                
                
                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_time, posts.upvotes, posts.upvotesweeks, posts.public, users.`username` FROM users, posts, followers Where posts.public = "public"
                ORDER BY posts.upvotesweeks DESC;', array(':userid'=>$userid));
              
              $response = "[";
              foreach($followingposts as $post) {
        
                      $response .= "{";
                              $response .= '"PostId": '.$post['id'].',';
                              $response .= '"PostBody": "'.$post['body'].'",';
                              $response .= '"PostedBy": "'.$post['username'].'",';
                              $response .= '"PostDate": "'.$post['posted_time'].'",';
                              $response .= '"UpVotes": '.$post['upvotes'].'';
                      $response .= "},";
        
        
              }
              $response = substr($response, 0, strlen($response)-1);
              $response .= "]";
        
              http_response_code(200);
              echo $response;
        
        
        }else if ($_GET['url'] == "popularmonth") {

                $token = $_COOKIE['MyBookCookie'];
        
                $userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
                
                
                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_time, posts.upvotes, posts.upvotesmonths, posts.public, users.`username` FROM users, posts, followers Where posts.public = "public"
                ORDER BY posts.upvotesmonths DESC;', array(':userid'=>$userid));
              
              $response = "[";
              foreach($followingposts as $post) {
        
                      $response .= "{";
                              $response .= '"PostId": '.$post['id'].',';
                              $response .= '"PostBody": "'.$post['body'].'",';
                              $response .= '"PostedBy": "'.$post['username'].'",';
                              $response .= '"PostDate": "'.$post['posted_time'].'",';
                              $response .= '"UpVotes": '.$post['upvotes'].'';
                      $response .= "},";
        
        
              }
              $response = substr($response, 0, strlen($response)-1);
              $response .= "]";
        
              http_response_code(200);
              echo $response;
        
        
        }
        
        
        
        
        
        
        
        
        
        
        
        
        else if ($_GET['url'] == "profileposts") {

              
        
                $userid = $db->query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
             
                
                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_time, posts.upvotes, users.`username` FROM users, posts
                  WHERE users.id = posts.user_id
                  AND users.id = :userid
                ORDER BY posts.upvotes DESC;', array(':userid'=>$userid));
              
              $response = "[";
              foreach($followingposts as $post) {
        
                      $response .= "{";
                              $response .= '"PostId": '.$post['id'].',';
                              $response .= '"PostBody": "'.$post['body'].'",';
                              $response .= '"PostedBy": "'.$post['username'].'",';
                              $response .= '"PostDate": "'.$post['posted_time'].'",';
                              $response .= '"UpVotes": '.$post['upvotes'].'';
                      $response .= "},";
        
        
              }
              $response = substr($response, 0, strlen($response)-1);
              $response .= "]";
        
              http_response_code(200);
              echo $response;
        
                
        
                }else if ($_GET['url'] == "peoplepage") {
                       
                        $people = $db->query("SELECT users.username, users.FirstName, users.LastName, users.UserDescription FROM users"); 
                   
                        $response = "[";
                      foreach($people as $users) {
                
                              $response .= "{";
                                      $response .= '"username": "'.$users['username'].'",';
                                      $response .= '"FirstName": "'.$users['FirstName'].'",';
                                      $response .= '"LastName": "'.$users['LastName'].'",';
                                      $response .= '"UserDescription": "'.$users['UserDescription'].'"';
                              $response .= "},";
                
                
                      }
                      $response = substr($response, 0, strlen($response)-1);
                      $response .= "]";
                
                      http_response_code(200);
                      echo $response;
                
                        }
                        

} else if ($_SERVER['REQUEST_METHOD'] == "POST") {


        if ($_GET['url'] == "users") {
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                $FirstName = $postBody->FirstName;
                $LastName = $postBody->LastName;
                $username = $postBody->username;
                $UserDescription = $postBody->UserDescription;
                $Country = $postBody->Country;
                $Birthday = $postBody->Birthday;
                $Email = $postBody->Email;
                $UserPass = $postBody->UserPass;
                $verified = 0;


                if (!$db->query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
               
                        if (strlen($username) >= 3 && strlen($username) <= 32) {
                             
                                if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                                      
                                        if (!$db->query('SELECT Email FROM users WHERE Email=:Email', array(':Email'=>$Email))) {
        
                                        if (strlen($UserPass) >= 6 && strlen($UserPass) <= 60) {
                                              
                                                if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        
        
                                                $db->query('INSERT INTO users VALUES (null,:username, :FirstName, :LastName, :UserDescription, :UserPass, :Email, :Country, :Birthday, :verified, null)', array(':username'=>$username, ':FirstName'=>$FirstName, ':LastName'=>$LastName, ':UserDescription'=>$UserDescription, ':UserPass'=>password_hash($UserPass, PASSWORD_BCRYPT), ':Email'=>$Email, ':Country'=>$Country, ':Birthday'=>$Birthday, 'verified'=>$verified));
                                                 Mail::sendMail('Welcome to MyBook!', 'Your account has been created!', $Email);
                                                 echo '{ "Success": "User Created!" }';
                                                http_response_code(200);
        
                                                 } else {
                                                        echo '{ "Error": "Email in use!" }';
                                                        http_response_code(409);
                                                 }
                                        } else {
                                                echo '{ "Error": "Invalid Password!" }';
                                                http_response_code(409);
                                         }
                                } else {
                                        echo '{ "Error": "Email in use!" }';
                                        http_response_code(409);
                                }
                        } else {
                                echo '{ "Error": "Invalid Username!" }';
                                http_response_code(409);
                        }
        
                         } else {
                                echo '{ "Error": "Invalid Username!" }';
                                http_response_code(409);
                        }
                } else {
                        echo '{ "Error": "User exists!" }';
                        http_response_code(409);
                }
        }

        if ($_GET['url'] == "auth") {
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                $Email = $postBody->Email;
                $UserPass = $postBody->UserPass;

                if ($db->query('SELECT Email FROM users WHERE Email=:Email', array(':Email'=>$Email))) {
                        if (password_verify($UserPass, $db->query('SELECT UserPass FROM users WHERE Email=:Email', array(':Email'=>$Email))[0]['UserPass'])) {
                                $cstrong = True;
                                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                                $user_id = $db->query('SELECT id FROM users WHERE Email=:Email', array(':Email'=>$Email))[0]['id'];
                                $db->query('INSERT INTO login_tokens VALUES (null, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                                echo '{ "Token": "'.$token.'" }';
                                setcookie("MyBookCookie", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        } else {
                                echo '{ "Error": "Invalid username or password!" }';
                                http_response_code(401);
                        }
                } else {
                        echo '{ "Error": "Invalid username or password!" }';
                        http_response_code(401);
                }

       
       
       
       
       
        } else if ($_GET['url'] == "upvotes") {
                $postId = $_GET['id'];
                $token = sha1($_COOKIE['MyBookCookie']);
                $voterId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$token))[0]['user_id'];
                echo($voterId);
                echo($postId);
              
                if (!$db->query('SELECT user_id FROM post_upvotes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$voterId))) {
                        $db->query('UPDATE posts SET upvotes=upvotes+1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('UPDATE posts SET upvotesdays=upvotesdays+1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('UPDATE posts SET upvotesweeks=upvotesweeks+1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('UPDATE posts SET upvotesmonths=upvotesmonths+1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('INSERT INTO post_upvotes VALUES (null, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$voterId));
                        $db->query('INSERT INTO post_upvotes_day VALUES (null, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$voterId));
                        $db->query('INSERT INTO post_upvotes_week VALUES (null, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$voterId));
                        $db->query('INSERT INTO post_upvotes_month VALUES (null, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$voterId));

                } else {
                        $db->query('UPDATE posts SET upvotes=upvotes-1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('UPDATE posts SET upvotesdays=upvotesdays-1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('UPDATE posts SET upvotesweeks=upvotesweeks-1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('UPDATE posts SET upvotesmonths=upvotesmonths-1 WHERE id=:postid', array(':postid'=>$postId));
                        $db->query('DELETE FROM post_upvotes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$voterId));
                        $db->query('DELETE FROM post_upvotes_day WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$voterId));
                        $db->query('DELETE FROM post_upvotes_week WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$voterId));
                        $db->query('DELETE FROM post_upvotes_month WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$voterId));
                }

                echo"{";
                echo'"UpVotes":';
                echo $db->query('SELECT upvotes FROM posts WHERE id=:postid', array(':postid'=>$postId))[0]['upvotes'];
                echo"}";
        }

        

}  else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        if ($_GET['url'] == "auth") {
                if (isset($_GET['token'])) {
                        if ($db->query("SELECT token FROM login_tokens WHERE token=:token", array(':token'=>sha1($_GET['token'])))) {
                                $db->query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_GET['token'])));
                                echo '{ "Status": "Success" }';
                                http_response_code(200);
                        } else {
                                echo '{ "Error": "Invalid token" }';
                                http_response_code(400);
                        }
                } else {
                        echo '{ "Error": "Malformed request" }';
                        http_response_code(400);
                }
        }
} else {
        http_response_code(405);
}
?>
