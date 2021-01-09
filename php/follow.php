<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$username1 = $_GET['username1'];
$username2 = $_GET['username2'];

$success = $database->followUser($username1, $username2);

if ($success){
    header("Location: userDetails.php?username=$username2");
    echo "User '{$username1}' now follows '{$username2}'!'";
}
else{
    echo "user '{$username1}' Can't follow '{$username2}'!";
}

?>

