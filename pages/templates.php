<?php
header("Content-Type: application/json");

$tweet = file_get_contents('templates/template_tweet.php');
$search = file_get_contents('templates/template_search.php');
$comment = file_get_contents('templates/template_comment.php');

$templates = array("tweet" => $tweet, "search" => $search,
        "comment" => $comment);

die(json_encode($templates));

?>

