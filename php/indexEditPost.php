<?php

session_start();

require_once('DatabaseHelper.php');
$database = new DatabaseHelper();

$post_id = '';
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
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
        body{ font: 14px sans-serif; }
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

    <form method="post" action="editPost.php?post_id=<?php echo $post_id; ?>">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                <input id="newtitle" name="newtitle" type="text" class="form-control">
                </div>
                <div class="form-group">
                <textarea class="form-control" id="newpostContent" name="newpostContent" rows="3" ></textarea>
                </div>
                <div class="mar-top clearfix">
                    <button type="submit" class="btn btn-light" value="Update">
                        Update
                    </button>
                    <a class="btn btn-trans btn-icon fa fa-video-camera add-tooltip" href="#" data-original-title="Add Video" data-toggle="tooltip"></a>
                    <a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#" data-original-title="Add Photo" data-toggle="tooltip"></a>
                    <a class="btn btn-trans btn-icon fa fa-file add-tooltip" href="#" data-original-title="Add File" data-toggle="tooltip"></a>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>