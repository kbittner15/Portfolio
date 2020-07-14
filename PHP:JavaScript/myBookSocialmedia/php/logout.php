<?php
include('./classes/DB.php');
include('./classes/Login.php');

if (!Login::isLoggedIn()) {
        die("Not logged in.");
}

if (isset($_POST['confirm'])) {

        if (isset($_POST['alldevices'])) {

                DB::query('DELETE FROM Login_Tokens WHERE User_ID=:userid', array(':userid'=>Login::isLoggedIn()));

        } else {
                if (isset($_COOKIE['MyBookCookie'])) {
                        DB::query('DELETE FROM Login_Tokens WHERE Token=:Token', array(':Token'=>sha1($_COOKIE['MyBookCookie'])));
                }
                setcookie('MyBookCookie', '1', time()-3600);
                setcookie('MyBookCookie_', '1', time()-3600);
        }

}

?>
<h1>Logout of your Account?</h1>
<p>Are you sure you'd like to logout?</p>
<form action="logout.php" method="post">
        <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
        <input type="submit" name="confirm" value="Confirm">
</form>
