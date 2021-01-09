

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="CSS/feed.css">


<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

session_start();

$postId = '';
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
}

$title = '';
if (isset($_GET['title'])) {
    $title = $_GET['title'];
}

$postContent = '';
if (isset($_GET['postContent'])) {
    $postContent = $_GET['postContent'];
}

$commentContent = '';
if (isset($_GET['commentContent'])) {
    $commentContent = $_GET['commentContent'];
}

$postDate = '';
if (isset($_GET['postDate'])) {
    $postDate = $_GET['postDate'];
}

$authorUsername = '';
if (isset($_GET['authorUsername'])) {
    $authorUsername = $_GET['authorUsername'];
}

$authorCurrentUsername = $_SESSION['username'];
$post_array = $database->selectAllPosts($postId, $title, $postContent, $postDate, $authorUsername);
$comment_array = $database->selectAllComments($postId);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>InterArt</title>
    <link rel="stylesheet" type="text/css" href="CSS/MyCssFile.css">
    <script src="JavaScript/myScript1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light " id="navi">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav nav-fill w-100 align-items-start">
                <li class="nav-item active">
                    <a class="nav-link" href="MainFeed.php">Feed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexMyProfile.php">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexMyPosts.php">My Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class='fas fa-user-alt'></i>
                        <?php echo $authorCurrentUsername ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</head>

<div class="container">
    <form method="post" action="addPost.php">
        <div class="panel">
            <div class="panel-body">
                <input id="title" name="title" type="text" class="form-control">
                <textarea class="form-control" id="postContent" name="postContent" rows="3"></textarea>
                <div class="mar-top clearfix">
                    <button type="submit" class="btn btn-light">
                        Add Post <i class="fa fa-plus"></i>
                    </button>
                    <a class="btn btn-trans btn-icon fa fa-video-camera add-tooltip" href="#" data-original-title="Add Video" data-toggle="tooltip"></a>
                    <a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#" data-original-title="Add Photo" data-toggle="tooltip"></a>
                    <a class="btn btn-trans btn-icon fa fa-file add-tooltip" href="#" data-original-title="Add File" data-toggle="tooltip"></a>
                </div>
            </div>
        </div>
    </form>
    <br>
    <hr>

    <div class="col-md-7">
        <div class="social-feed-separated">
            <div class="social-feed-box">
                <?php foreach ($post_array as $post) : ?>
                    <?php $comment_array = $database->selectAllComments($post['POSTID']); ?>
                    <div class="social-avatar">
                        <img class="editable img-responsive" alt=" Avatar" id="avatar2" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                        <a href="userDetails.php?username=<?php echo $post['AUTHORUSERNAME']; ?>">
                            <?php echo $post['AUTHORUSERNAME']; ?>
                        </a>
                    </div>
                    <div class="social-body">
                        <p class = "postTitle">
                            <?php echo $post['TITLE']; ?>
                        </p>
                        <p>
                            <?php echo $post['POSTCONTENT']; ?>
                        </p>
                        <p>
                            <?php
                            $medurl = $database->getMedia($post['POSTID']);
                            foreach ($medurl as $md) :
                                foreach ($md as $m) :
                                    ?>
                                    <img src="<?php echo $m; ?>" class="img-responsive">
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </p>
                        <div class="btn-group">
                            <form method="post" action="likepost.php?postId=<?php echo $post['POSTID']?>">
                                <div>
                                    <span>
                                        <button type="submit" class="btn btn-light btn-xs">
                                            <i class="fa fa-thumbs-up"></i> Like this!
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <br>
                        <small class="text-muted"><?php echo $post['POSTDATE']; ?>  <?php echo $database->numberOfPostLikes($post['POSTID']); ?>   Likes </small> <a href="#" class="small"><i class="fa fa-thumbs-up"></i> </a>
                        <div class="social-footer">
                            <form method="post" action="addComment.php?postId=<?php echo $post['POSTID']?>&authorUsername=<?php echo $authorCurrentUsername; ?>">
                                <div class="panel">
                                    <div class="panel-body">
                                        <textarea class="form-control" id="commentContent" name="commentContent" rows="2"></textarea>
                                        <div class="mar-top clearfix">
                                            <button type="submit" class="btn btn-light">
                                                Add Comment <i class="fa fa-plus"></i>
                                            </button>
                                            <a class="btn btn-trans btn-icon fa fa-video-camera add-tooltip" href="#" data-original-title="Add Video" data-toggle="tooltip"></a>
                                            <a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#" data-original-title="Add Photo" data-toggle="tooltip"></a>
                                            <a class="btn btn-trans btn-icon fa fa-file add-tooltip" href="#" data-original-title="Add File" data-toggle="tooltip"></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <?php foreach ($comment_array as $comment) : ?>
                                <?php $commlikes = $database->numberOfCommentLikes($comment['COMMENTID']); ?>
                                <div class="social-comment">
                                    <a href="" class="pull-left">
                                        <img alt="image" src="https://bootdey.com/img/Content/avatar/avatar2.png">
                                    </a>
                                    <div class="media-body">
                                        <a href="userDetails.php?username=<?php echo $comment['AUTHORUSERNAME']; ?>">
                                            <?php echo $comment['AUTHORUSERNAME']; ?>
                                        </a>
                                        <?php echo $comment['COMMENTCONTENT']; ?>
                                        <br>
                                        <form method="post" action="likes.php?commentId=<?php echo $comment['COMMENTID']?>">
                                            <div>
                                                <span>
                                                    <button type="submit" class="btn btn-light btn-xs">
                                                        <a href="#" class="small"><i class="fa fa-thumbs-up"></i> </a> Like this!
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                        <small class="text-muted"><?php echo $comment['COMMENTDATE']; ?> Likes <?php echo $database->numberOfCommentLikes($comment['COMMENTID']); ?> </small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

