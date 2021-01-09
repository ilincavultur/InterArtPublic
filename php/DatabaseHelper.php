<?php

class DatabaseHelper
{
    // Since the connection details are constant, define them as const
    // We can refer to constants like e.g. DatabaseHelper::username
    const username = '*'; // use a + your matriculation number
    const password = '*'; // use your oracle db password
    const con_string = 'lab';

    // Since we need only one connection object, it can be stored in a member variable.
    // $conn is set in the constructor.
    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            // Create connection with the command oci_connect(String(username), String(password), String(connection_string))
            // The @ sign avoids the output of warnings
            // It could be helpful to use the function without the @ symbol during developing process
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        // clean up
        @oci_close($this->conn);
    }

    /**
     * @param $userId
     * @param $username
     * @param $email
     * @param $kennwort
     * @return mixed
     */
    public function selectAllUsers($userId, $username, $email, $kennwort)
    {

        $sql = "SELECT * FROM appuser
            WHERE userId LIKE '%{$userId}%'
              AND upper(username) LIKE upper('%{$username}%')
              AND upper(email) LIKE upper('%{$email}%')
              AND upper(kennwort) LIKE upper('%{$kennwort}%')";


        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);


        @oci_free_statement($statement);

        return $res;
    }

    public function selectAllPosts($postId, $title, $postContent, $postDate, $authorUsername)
    {
        $sql = "SELECT * FROM post
            WHERE postId LIKE '%{$postId}%'
              AND upper(title) LIKE upper('%{$title}%')
              AND upper(postContent) LIKE upper('%{$postContent}%')
              AND upper(postDate) LIKE upper('%{$postDate}%')
              AND upper(authorUsername) LIKE upper('%{$authorUsername}%')";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }

    public function selectAllPosts2($authorUsername)
    {
        $sql = "SELECT * FROM post
            WHERE upper(authorUsername) LIKE upper('%{$authorUsername}%')";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }

    public function selectAllFollowing($username)
    {
        $sql = "SELECT username2 FROM follow
            WHERE username1 LIKE '%{$username}%'";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_COLUMN);

        @oci_free_statement($statement);

        return $res;
    }

    public function selectAllComments($postId)
    {
        $sql = "SELECT * FROM appcomment
            WHERE postId LIKE '%{$postId}%' ";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        return $res;
    }

    public function numberOfPostLikes($postId)
    {
        $sql = "SELECT * FROM likepost
            WHERE postId LIKE '%{$postId}%' ";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement) && @oci_commit($this->conn);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        $rows = count($res, COUNT_NORMAL);

        return $rows;
    }

    public function numberOfCommentLikes($commentId)
    {
        $sql = "SELECT * FROM likes
            WHERE commentId LIKE '%{$commentId}%' ";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement) && @oci_commit($this->conn);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        $rows = count($res, COUNT_NORMAL);

        return $rows;

    }

    public function numberOfFollowers($username)
    {
        $sql = "SELECT * FROM follow
            WHERE username2 LIKE '%{$username}%' ";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement) && @oci_commit($this->conn);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        $rows = count($res, COUNT_NORMAL);

        return $rows;
    }

    public function numberOfFollowing($username)
    {
        $sql = "SELECT * FROM follow
            WHERE username1 LIKE '%{$username}%' ";

        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement) && @oci_commit($this->conn);

        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        @oci_free_statement($statement);

        $rows = count($res, COUNT_NORMAL);

        return $rows;
    }

    /**
     * @param $username
     * @param $email
     * @param $kennwort
     * @return bool
     */
    public function insertIntoUser($username, $email, $kennwort)
    {

        $sql = "INSERT INTO appuser (username, email, kennwort) VALUES ('{$username}', '{$email}', '{$kennwort}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoAuthor($username, $email, $kennwort)
    {

        $sql = "INSERT INTO author (username, email, kennwort) VALUES ('{$username}', '{$email}', '{$kennwort}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoFollower($username, $email, $kennwort)
    {

        $sql = "INSERT INTO follower (username, email, kennwort) VALUES ('{$username}', '{$email}', '{$kennwort}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoComment($commentContent, $authorUsername, $postId)
    {
        $sql = "INSERT INTO appcomment (commentDate, commentContent, authorUsername, postId) VALUES (current_date, '{$commentContent}', '{$authorUsername}', '{$postId}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoPost($title, $postContent, $authorUsername)
    {
        $sql = "INSERT INTO post (title, postContent, postDate, authorUsername) VALUES ('{$title}', '{$postContent}', current_date,  '{$authorUsername}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function followUser($username1, $username2)
    {
        $sql = "INSERT INTO follow (username1, username2) VALUES ('{$username1}', '{$username2}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function likesComment($followerUsername, $commentId)
    {
        $sql = "INSERT INTO likes (followerUsername, commentId) VALUES ('{$followerUsername}', '{$commentId}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function likesPost($followerUsername, $postId)
    {
        $sql = "INSERT INTO likepost (followerUsername, postId) VALUES ('{$followerUsername}', '{$postId}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function contains($postId, $mediaId)
    {
        $sql = "INSERT INTO contains (postId, mediaId) VALUES ('{$postId}', '{$mediaId}')";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function getMedia($postId)
    {
        $sql = "SELECT mediaPath FROM media WHERE mediaId = (SELECT mediaId FROM contains WHERE postId = '{$postId}')";

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement) && @oci_commit($this->conn);
        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_COLUMN);

        return $res;
    }

    public function getEmail($username)
    {
        $sql = "SELECT email FROM appuser WHERE username = '{$username}'";

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement) && @oci_commit($this->conn);
        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        return $res;
    }

    public function getTitle($post_id)
    {
        $sql = "SELECT title FROM post WHERE post_id = '{$post_id}'";

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement) && @oci_commit($this->conn);

        return @oci_fetch($statement);
    }

    public function getPostContent($post_id)
    {

        $sql = "SELECT postContent FROM post WHERE post_id = '{$post_id}'";

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement) && @oci_commit($this->conn);

        return @oci_fetch($statement);
    }

    public function editPost($post_id, $newtitle, $newpostContent)
    {

        $sql = "UPDATE post SET title='{$newtitle}', postContent='{$newpostContent}' WHERE postid={$post_id}";

        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function deleteUser($p_user_id)
    {
        $errorcode = 0;

        $sql = 'BEGIN P_DELETE_USER(:p_user_id, :errorcode); END;';
        $statement = @oci_parse($this->conn, $sql);

        @oci_bind_by_name($statement, ':p_user_id', $p_user_id);
        @oci_bind_by_name($statement, ':errorcode', $errorcode);

        @oci_execute($statement);
        @oci_free_statement($statement);

        return $errorcode;
    }

    public function deletePost($p_post_id)
    {
        $errorcode = 0;

        $sql = 'BEGIN P_DELETE_POST(:p_post_id, :errorcode); END;';
        $statement = @oci_parse($this->conn, $sql);

        @oci_bind_by_name($statement, ':p_post_id', $p_post_id);
        @oci_bind_by_name($statement, ':errorcode', $errorcode);

        @oci_execute($statement);
        @oci_free_statement($statement);

        return $errorcode;
    }

    public function deleteAuthor($p_user_username)
    {
        $errorcode = 0;

        $sql = 'BEGIN P_DELETE_AUTHOR(:p_user_username, :errorcode); END;';
        $statement = @oci_parse($this->conn, $sql);

        @oci_bind_by_name($statement, ':p_user_username', $p_user_username);
        @oci_bind_by_name($statement, ':errorcode', $errorcode);

        @oci_execute($statement);
        @oci_free_statement($statement);

        return $errorcode;
    }

    public function deleteFollower($p_user_username)
    {
        $errorcode = 0;

        $sql = 'BEGIN P_DELETE_FOLLOWER(:p_user_username, :errorcode); END;';
        $statement = @oci_parse($this->conn, $sql);

        @oci_bind_by_name($statement, ':p_user_username', $p_user_username);
        @oci_bind_by_name($statement, ':errorcode', $errorcode);

        @oci_execute($statement);
        @oci_free_statement($statement);

        return $errorcode;
    }
}