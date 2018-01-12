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

if (!isset($json->comment)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "comment required.";
    $model->publish();
}

//create comment

$result = DB::connect()->insertIn("user_comments")
    ->columnAsNumber("user_id", $user_id)
    ->columnAsNumber("post_id", $json->post_id)
    ->columnAsString("comment", $json->comment)
    ->save();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while inserting data in user_comments table";
    $model->publish();
}


$model->status = 1;
$model->data = array("id" => mysqli_insert_id(DB::connect()->getLink()));
$model->publish();