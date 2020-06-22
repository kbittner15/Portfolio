<?php

class Login {

    public static function isLoggedIn() {
   
        if (isset($_COOKIE['MyBookCookie'])) {
                if (DB::query('SELECT User_ID FROM Login_Tokens WHERE Token=:Token', array(':Token'=>sha1($_COOKIE['MyBookCookie'])))) {
                 $userid = DB::query('SELECT User_ID FROM Login_Tokens WHERE Token=:Token', array(':Token'=>sha1($_COOKIE['MyBookCookie'])))[0]['User_ID'];

                       if (isset($_COOKIE['MyBookCookie_'])) {
                           return $userid;
                      } else {
                            $VTRUE = True;
                                $Token = bin2hex(openssl_random_pseudo_bytes(64, $VTRUE));
                               DB::query('INSERT INTO Login_Tokens VALUES (null, :Token, :User_ID)', array(':Token'=>sha1($Token), ':User_ID'=>$userid));
                               DB::query('DELETE FROM Login_Tokens WHERE Token=:Token', array(':Token'=>sha1($_COOKIE['MyBookCookie'])));

                              setcookie("MyBookCookie", $Token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                              setcookie("MyBookCookie_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                              return $userid;
                       }
             }
        }

        return false;
}
}



?>