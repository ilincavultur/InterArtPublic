<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$post_id = '';
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    echo $post_id;
}

$error_code = $database->deletePost($post_id);

if ($error_code == 1){
    header("Location: indexMyPosts.php");
}
else{
    echo "Error can't delete Post with ID: '{$post_id}'. Errorcode: {$error_code}";
}
?>

