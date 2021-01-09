<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

session_start();

$followerUsername = $_SESSION['username'];

$postId = $_GET['postId'];

$success = $database->likesPost($followerUsername, $postId);

if ($success){
    header("Location: MainFeed.php");
}
else{
    echo "Can't like post '{$postId}'!";
}

?>
