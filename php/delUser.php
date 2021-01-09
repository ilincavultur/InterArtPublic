<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$user_id = '';
if(isset($_POST['id'])){
    $user_id = $_POST['id'];
}

$username = '';
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

$error_code = $database->deleteUser($user_id);

if ($error_code == 1){
    $error_code = $database->deleteAuthor($username);
    $error_code = $database->deleteUser($username);

    echo "User with ID: '{$user_id}' successfully deleted!'";
}
else{
    echo "Error can't delete User with ID: '{$user_id}'. Errorcode: {$error_code}";
}
?>
