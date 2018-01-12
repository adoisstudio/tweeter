<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:46 PM
 */

include_once 'base_api.php';

//need post id

if (!isset($json->post_id)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "post_id required.";
    $model->publish();
}


if (!isPostExist($json->post_id)) {
    $model->err_code = ErrorCodes::$INVALID_VALUE;
    $model->msg = "post id not exist.";
    $model->publish();
}

//like post
$result = DB::connect()->select("*")
    ->from("user_likes")->where()
    ->numberOf("user_id", $user_id)->also()
    ->numberOf("post_id", $json->post_id)
    ->run();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while checking like record. " . DB::connect()->getError();
    $model->publish();
}

if (mysqli_num_rows($result) == 0) {

    $result = DB::connect()->insertIn("user_likes")
        ->columnAsNumber("user_id", $user_id)
        ->columnAsNumber("post_id", $json->post_id)
        ->save();

    if (!$result) {
        $model->err_code = ErrorCodes::$QUERY_FAILED;
        $model->msg = "failed while inserting data in user_likes table. " . DB::connect()->getError();
        $model->publish();
    }

    $model->status = 1;
    $model->data = "you liked this post.";
    $model->publish();
} else {

    $row = mysqli_fetch_object($result);
    $result = false;

    if ($row->liking) {

        $result = DB::connect()->updateIn("user_likes")
            ->setNumberOf("liking", 0)->where()
            ->numberOf("like_id", $row->like_id)->run();

        $model->data = array("liking" => 0);
    } else {

        $result = DB::connect()->updateIn("user_likes")
            ->setNumberOf("liking", 1)->where()
            ->numberOf("like_id", $row->like_id)->run();

        $model->data = array("liking" => 1);
    }

    if (!$result) {
        $model->err_code = ErrorCodes::$QUERY_FAILED;
        $model->msg = "failed while inserting data in user_likes table. " . DB::connect()->getError();
        $model->publish();
    }

    $model->status = 1;
    $model->publish();

}//if