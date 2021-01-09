
<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

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

$password_err = null;
$email_err = null;
$username_err = null;

/*
if(empty($username)){
    $username_err = "Please enter a username.";
} else{
    $sql = "SELECT * FROM appuser
            WHERE username LIKE '%{$username}%' ";

    $statement = @oci_parse($link, $sql);

    @oci_execute($statement) && @oci_commit($link);

    @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

    @oci_free_statement($statement);

    $rows = count($res, COUNT_NORMAL);

    if($rows > 0){
        $username_err = "This username is already taken.";
    }
}

if(empty($email)){
    $email_err = "Please enter an email.";
} else{
    $sql = "SELECT * FROM appuser
            WHERE email LIKE '%{$email}%' ";

    $statement = @oci_parse($link, $sql);

    @oci_execute($statement) && @oci_commit($link);

    @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

    @oci_free_statement($statement);

    $rows = count($res, COUNT_NORMAL);

    if($rows > 0){
        $email_err = "This email is already taken.";
    }else{
        $email = $_POST['email'];
    }
}

if(empty($kennwort)){
    $password_err = "Please enter a password.";
}
*/
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

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    }
    if(empty(trim($_POST["kennwort"]))){
        $password_err = "Please enter your password.";
    }

    if(empty($username_err) && empty($password_err) && empty($email_err)){

        $sql = "SELECT * FROM appuser
            WHERE username LIKE '%{$username}%' ";

        $statement = @oci_parse($link, $sql);

        @oci_execute($statement) && @oci_commit($link);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        $rows = count($res, COUNT_NORMAL);

        if($rows > 0){
            $username_err = "This username is already taken.";
        }else{

            $sql = "SELECT * FROM appuser
            WHERE email LIKE '%{$email}%' ";

            $statement = @oci_parse($link, $sql);

            @oci_execute($statement) && @oci_commit($link);

            @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

            @oci_free_statement($statement);

            $rows = count($res, COUNT_NORMAL);

            if($rows > 0){
                $email_err = "This email is already taken.";
            }
        }
    }
    @oci_close($link);
}

$success = null;

if(empty($username_err) && empty($email_err) && empty($password_err)){
    $success = $database->insertIntoUser($username, $email, $kennwort);
}else{
    echo "Error can't insert User '{$username} {$email}'!";
}

if ($success){
    $success = $database->insertIntoAuthor($username, $email, $kennwort);
    $success = $database->insertIntoFollower($username, $email, $kennwort);
    header("Location: register.php");
}

@oci_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; vertical-align: middle; flex: auto; }
        h2{justify-content: center}
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light " id="navi">
        <h2>InterArt</h2>
    </nav>
</head>

<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="kennwort" class="form-control" value="<?php echo $kennwort; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
