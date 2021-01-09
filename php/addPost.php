<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

session_start();

$title = '';
if(isset($_POST['title'])){
    $title = $_POST['title'];
}

$postContent = '';
if(isset($_POST['postContent'])){
    $postContent = $_POST['postContent'];
}

$authorUsername = '';
if(isset($_POST['authorUsername'])){
    $authorUsername = $_POST['authorUsername'];
}
$authorUsername = null;
$authorUsername = $_SESSION["username"];

$success = $database->insertIntoPost($title, $postContent, $authorUsername);

if ($success){
    header("Location: MainFeed.php");
    exit();
}
else{
    echo "Error can't insert Post by '{$authorUsername}'!";
}

?>

