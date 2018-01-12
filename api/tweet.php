<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 14/12/17
 * Time: 11:02 PM
 */

include_once 'base_api.php';

//tweet api required session_id, post_type, post_data

if (!isset($json->post_type)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "post_type required.";

    die(json_encode($model));
}

if (!isset($json->post_text)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "post_text required.";

    die(json_encode($model));
}

if (!isset($json->img_id)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "img_id required.";

    die(json_encode($model));
}

if ($json->post_type < TweetCode::$TYPE_TEXT || $json->post_type > TweetCode::$TYPE_BOTH) {

    $model->err_code = ErrorCodes::$INVALID_VALUE;
    $model->msg = "invalid post type. must be 1,2,3";

    die(json_encode($model));
}

if (empty($json->post_text) && $json->post_type == TweetCode::$TYPE_TEXT) {

    $model->err_code = ErrorCodes::$INVALID_VALUE;
    $model->msg = "post text required.";

    die(json_encode($model));
}


//create tweet
include_once '../db/DB.php';

$result = DB::connect()->insertIn("user_post")
    ->columnAsNumber("user_id", $user_id)
    ->columnAsNumber("post_type", $json->post_type)
    ->columnAsString("post_text", $json->post_text)
    ->columnAsString("img_id", $json->img_id)
    ->save();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while inserting data in user_post table";
    $model->publish();
}

$post_id = mysqli_insert_id(DB::connect()->getLink());

$result = DB::connect()->insertIn("user_likes")
    ->columnAsNumber("user_id", $user_id)
    ->columnAsNumber("post_id", $post_id)
    ->columnAsNumber("liking", 0)
    ->save();

$result = DB::connect()
    ->select("user_detail.user_name, user_detail.user_dp_url, user_post.*, user_likes.liking")
    ->from("((user_post INNER JOIN user_detail ON user_post.user_id = user_detail.user_id)
     INNER JOIN user_follow ON user_post.user_id = user_follow.user_id) 
     INNER JOIN user_likes ON user_post.post_id = user_likes.post_id")
    ->where()
    ->numberOf("user_post.post_id", $post_id)
    ->run();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while selecting user_post table";
    $model->publish();
}

$row = mysqli_fetch_assoc($result);
$model->data = $row;

$model->status = 1;
$model->publish();