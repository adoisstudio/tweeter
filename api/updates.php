<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:46 PM
 */

include_once 'base_api.php';

$post_id = 0;

if (isset($json->max_tweet_id)) {
    $post_id = $json->max_tweet_id;
}


$result = DB::connect()
    ->select(" user_login.user_name as username, user_detail.user_name,
     user_detail.user_dp_url, user_post.*, user_likes.liking")
    ->from("((user_post INNER JOIN user_detail ON user_post.user_id = user_detail.user_id)
     INNER JOIN user_follow ON user_post.user_id = user_follow.user_id) 
     INNER JOIN user_likes ON user_post.post_id = user_likes.post_id 
     INNER JOIN user_login ON user_login.user_id = user_detail.user_id")
    ->where()
    ->numberOf("user_follow.followed_by", $user_id)
    ->run(" AND user_post.post_id > $post_id");

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while selecting user_post table: " . DB::connect()->getError();
    $model->publish();
}

$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

$data = array("notifs" => 0, "tweets" => $rows, "messages" => 0);

$model->status = 1;
$model->data = $data;
$model->publish();