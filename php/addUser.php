<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$userId = '';
if(isset($_POST['userId'])){
    $username = $_POST['userId'];
}

$username = '';
if(isset($_POST['username'])){
    $username = $_POST['username'];
}

$email = '';
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

$kennwort = '';
if(isset($_POST['kennwort'])){
    $kennwort = $_POST['kennwort'];
}

$success = $database->insertIntoUser($username, $email, $kennwort);

if ($success){
    $success = $database->insertIntoAuthor($username, $email, $kennwort);
    $success = $database->insertIntoFollower($username, $email, $kennwort);
    echo "User '{$username} {$email} {$kennwort}' successfully added!'";
}
else{
    echo "Error can't insert User '{$username} {$email} {$kennwort}'!";
}

?>


