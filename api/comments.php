<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 14/12/17
 * Time: 11:02 PM
 */

include_once 'base_api.php';


if (!isset($json->post_id)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "post_id required.";
    $model->publish();
}

//create comment

$result = DB::connect()->select(
    "user_comments.user_id, user_comments.comment, user_comments.commented_on,
    user_detail.user_name, user_detail.user_dp_url")->from("
    user_comments INNER JOIN user_detail ON user_comments.user_id = user_detail.user_id")
    ->where()
    ->numberOf("post_id", $json->post_id)
    ->run();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while selecting user_comments table " . DB::connect()->getError();
    $model->publish();
}


$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

$model->data = $rows;

$model->status = 1;
$model->publish();