<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="CSS/feed.css">

<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

session_start();

$username = $_GET['username'];

$username1 = $_SESSION['username'];
$post_array = $database->selectAllPosts2($username);

$useremail = $database->getEmail($username);
$noOfFollowers = $database->numberOfFollowers($username);
$noOfFollowing = $database->numberOfFollowing($username);
$following_array = $database->selectAllFollowing($username);

?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="CSS/MyProfile.css">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
                        <?php echo $username ?>
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
    <div id="user-profile-2" class="user-profile">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-18">
                <li class="active">
                    <a data-toggle="tab" href="#home">
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#feed">
                        <i class="orange ace-icon fa fa-rss bigger-120"></i>
                        Activity Feed
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#friends">
                        <i class="blue ace-icon fa fa-users bigger-120"></i>
                        Following
                    </a>
                </li>
            </ul>
            <div class="tab-content no-border padding-24">
                <div id="home" class="tab-pane in active">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 center">
                              <span class="profile-picture">
                                <img class="editable img-responsive" alt=" Avatar" id="avatar2" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                              </span>
                            <div class="space space-4"></div>
                            <form method="post" action="follow.php?username1=<?php echo $username1?>&username2=<?php echo $username?>">
                                <div>
                                    <span>
                                        <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                                        <button type="submit" class="btn btn-success">
                                            Follow
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div><!-- /.col -->
                        <div class="col-xs-12 col-sm-9">
                            <h4 class="blue">
                                <span class="middle"></span>
                                <span class="label label-purple arrowed-in-right">
                                  <i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                                  <?php echo $username ?>
                                </span>
                            </h4>
                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Username </div>

                                    <div class="profile-info-value">
                                        <span><?php echo $username ?></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Location </div>

                                    <div class="profile-info-value">
                                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                                        <span>Vienna</span>
                                        <span>Austria</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Age </div>
                                    <div class="profile-info-value">
                                        <span>38</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Email </div>
                                    <div class="profile-info-value">
                                        <?php foreach ($useremail as $em) : ?>
                                            <?php foreach ($em as $e) : ?>
                                                <span><?php echo $e?></span>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Followers </div>
                                    <div class="profile-info-value">
                                        <span><?php echo $noOfFollowers ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr-8 dotted"></div>
                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Website </div>
                                    <div class="profile-info-value">
                                        <a href="#" target="_blank">www.<?php echo $username ?>.com</a>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name">
                                        <i class="middle ace-icon fa fa-facebook-square bigger-150 blue"></i>
                                    </div>
                                    <div class="profile-info-value">
                                        <a href="#">Find me on Facebook</a>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name">
                                        <i class="middle ace-icon fa fa-twitter-square bigger-150 light-blue"></i>
                                    </div>
                                    <div class="profile-info-value">
                                        <a href="#">Follow me on Twitter</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="space-20"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-small">
                                    <h4 class="widget-title smaller">
                                        <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                                        Little About Me
                                    </h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </p>
                                        <p>
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqu
                                        </p>
                                        <p>
                                            Ut enim ad minim veniam
                                        </p>
                                        <p>
                                            Excepteur sint occaecat cupidatat non proident
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /#home -->

                <div id="feed" class="tab-pane">
                    <div class="container">
                        <div class="col-md-7">
                            <div class="social-feed-separated">
                                <div class="social-feed-box">
                                    <?php foreach ($post_array as $post) : ?>
                                        <?php $comment_array = $database->selectAllComments($post['POSTID']); ?>
                                            <div class="social-avatar">
                                                <a href="#">
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
                                                <small class="text-muted"><?php echo $post['POSTDATE']; ?> Likes <?php echo $database->numberOfPostLikes($post['POSTID']); ?> </small> <a href="#" class="small"><i class="fa fa-thumbs-up"></i> </a>
                                            </div>
                                            <div class="social-footer">
                                                <form method="post" action="addComment.php?postId=<?php echo $post['POSTID']?>&authorUsername=<?php echo $username1; ?>">
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
                                                                <a href="#">
                                                                    <?php echo $comment['AUTHORUSERNAME']; ?>
                                                                </a>
                                                                <?php echo $comment['COMMENTCONTENT']; ?>
                                                                <br>
                                                                <small class="text-muted"><?php echo $comment['COMMENTDATE']; ?> Likes <?php echo $database->numberOfCommentLikes($comment['COMMENTID']); ?> </small> <a href="#" class="small"><i class="fa fa-thumbs-up"></i> </a>
                                                            </div>
                                                        </div>
                                                <?php endforeach; ?>
                                            </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="space-12"></div>
                    </div>
                </div>

                <div id="friends" class="tab-pane">
                    <div class="profile-users clearfix">
                        <div class="itemdiv memberdiv">
                            <div class="inline pos-rel">
                                <?php foreach ($following_array as $following) : ?>
                                    <?php foreach ($following as $f) : ?>
                                        <div class="user">
                                            <a href="#">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Bob Doe's avatar">
                                            </a>
                                        </div>
                                        <div class="body">
                                            <div class="name">
                                                <a href="userDetails.php?username=<?php echo $f; ?>">
                                                    <span class="user-status status-online"></span>
                                                    <?php echo $f; ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="hr hr10 hr-double"></div>
                </div><!-- /#friends -->
            </div>
        </div>
    </div>
</div>