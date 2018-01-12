<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 14/12/17
 * Time: 11:02 PM
 */

include_once 'base_api.php';

$add = "";
$result = false;

if (isset($json->id)) {

    $result = DB::connect()
        ->select("DISTINCT user_login.user_name as username, user_detail.user_name, 
        user_detail.user_dp_url, user_post.*, user_likes.liking")
        ->from("((user_post INNER JOIN user_detail ON user_post.user_id = user_detail.user_id)
     INNER JOIN user_follow ON user_post.user_id = user_follow.user_id) 
     INNER JOIN user_likes ON user_post.post_id = user_likes.post_id 
     INNER JOIN user_login ON user_login.user_id = user_detail.user_id")
        ->where()
        ->numberOf("user_follow.followed_by", $json->id)
        ->also()
        ->numberOf("user_follow.following", 1)
        ->run("ORDER BY created_on DESC");


} else {

    $result = DB::connect()
        ->select("DISTINCT user_login.user_name as username, user_detail.user_name, user_detail.user_dp_url, 
    user_post.*, user_likes.liking")
        ->from("((user_post INNER JOIN user_detail ON user_post.user_id = user_detail.user_id)
     INNER JOIN user_follow ON user_post.user_id = user_follow.user_id) 
     INNER JOIN user_likes ON user_post.post_id = user_likes.post_id 
     INNER JOIN user_login ON user_login.user_id = user_detail.user_id")
        ->where()
        ->numberOf("user_follow.followed_by", $user_id)
        ->also()
        ->numberOf("user_follow.following", 1)
        ->run("ORDER BY created_on DESC");
}

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while selecting user_post table";
    $model->publish();
}

$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

$model->data = $rows;


$model->status = 1;
$model->publish();