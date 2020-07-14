<?php
require_once("DB.php");

$db = new DB("127.0.0.1", "MyBookData", "user", "12345678");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_GET['url'] == "days") {
    $db->query('UPDATE posts SET upvotesdays=0');
    $db->query('DELETE FROM post_upvotes_day');

}
if ($_GET['url'] == "weeks") {
    $db->query('UPDATE posts SET upvotesweeks=0');
    $db->query('DELETE FROM post_upvotes_week');

}
if ($_GET['url'] == "months") {
    $db->query('UPDATE posts SET upvotesmonths=0');
    $db->query('DELETE FROM post_upvotes_month');

}
}
?>