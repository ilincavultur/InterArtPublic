<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$post_id = '';
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}

$newtitle = '';
if(isset($_POST['newtitle'])){
    $newtitle = $_POST['newtitle'];
}

$newpostContent = '';
if(isset($_POST['newpostContent'])){
    $newpostContent = $_POST['newpostContent'];
}

$success = $database->editPost($post_id, $newtitle, $newpostContent);

if ($success){

    header("Location: indexMyPosts.php");
    exit();
}
else{
    echo "Error can't edit Post '{$post_id}'!";
}

?>

