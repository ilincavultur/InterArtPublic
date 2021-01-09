<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

session_start();

$followerUsername = $_SESSION['username'];

$commentId = $_GET['commentId'];

$success = $database->likesComment($followerUsername, $commentId);

if ($success){
    header("Location: MainFeed.php");
}
else{
    echo "Can't like comment '{$commentId}'!";
}

?>
