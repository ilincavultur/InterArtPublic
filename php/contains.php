<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$postId = '';
if(isset($_POST['postId'])){
    $postId = $_POST['postId'];
}

$mediaId = '';
if(isset($_POST['mediaId'])){
    $mediaId = $_POST['mediaId'];
}

$success = $database->contains($postId, $mediaId);

if ($success){
    echo "Post '{$postId}' contains media '{$mediaId}'!'";
}
else{
    echo "Can't add media '{$mediaId}' to post '{$postId}'!";
}

?>
