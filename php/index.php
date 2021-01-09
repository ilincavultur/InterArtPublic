<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: MainFeed.php");
    exit;
}

require_once('DatabaseHelper.php');

try {
    $link = @oci_connect(
        DatabaseHelper::username,
        DatabaseHelper::password,
        DatabaseHelper::con_string
    );

    if (!$link) {
        die("DB error: Connection can't be established!");
    }

} catch (Exception $e) {
    die("DB error: {$e->getMessage()}");
}

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

$username_err = null;
$password_err = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    }
    if(empty(trim($_POST["kennwort"]))){
        $password_err = "Please enter your password.";
    }

    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT * FROM appuser
            WHERE username LIKE '%{$username}%' ";

        $statement = @oci_parse($link, $sql);

        @oci_execute($statement) && @oci_commit($link);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        $rows = count($res, COUNT_NORMAL);

        if($rows > 0){

            $pass = "SELECT kennwort FROM appuser WHERE username = '{$username}'";
            $statement = @oci_parse($link, $pass);

            @oci_execute($statement) && @oci_commit($link);

            if($kennwort == @oci_fetch($statement)){
                session_start();

                $_SESSION["loggedin"] = true;
                $_SESSION["userId"] = $userId;
                $_SESSION["username"] = $username;

                header("location: MainFeed.php");
            }else{
                $password_err = "The password you entered was not valid.";
            }
            @oci_free_statement($statement);

        }
    }

    @oci_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/MyCssFile.css">
    <script src="JavaScript/myScript1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;}
        .wrapper{ width: 350px; padding: 20px; }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light " id="navi">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav nav-fill w-100 align-items-start">
                <h2>InterArt</h2>
            </ul>
        </div>
    </nav>
</head>

<body>
<div class="wrapper">
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="kennwort" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
</div>
</body>
</html>