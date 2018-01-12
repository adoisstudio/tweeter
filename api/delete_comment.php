<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:46 PM
 */

include_once 'base_api.php';

//need post id

if (!isset($json->comment_id)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "comment_id required.";
    $model->publish();
}

//delete comment
$result = DB::connect()->updateIn("user_comments")
    ->setNumberOf("deleted", 1)->where()
    ->numberOf("comment_id", $json->comment_id)
    ->also()
    ->numberOf("user_id", $user_id)
    ->run();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while deleting comment. " . DB::connect()->getError();
    $model->publish();
}

$model->status = 1;
$model->data = "comment deleted.";
$model->publish();