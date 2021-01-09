<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$commentContent = '';
if(isset($_POST['commentContent'])){
    $commentContent = $_POST['commentContent'];
}

$authorUsername = $_GET['authorUsername'];

$postId = $_GET['postId'];

$success = $database->insertIntoComment($commentContent, $authorUsername, $postId);

if ($success){
    header("Location: MainFeed.php");
}
else{
    echo "Error can't insert Comment by '{$authorUsername}'!";
}

?>
