<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:46 PM
 */

include_once 'base_api.php';

//follow

if (!isset($json->id_type)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "id_type required.";
    $model->publish();
}

if ($json->id_type < IDType::$USER_ID && $json->id_type > IDType::$USER_EMAIL) {
    $model->err_code = ErrorCodes::$INVALID_VALUE;
    $model->msg = "invalid id_type. must be 1 for user_name and 2 for email";
    $model->publish();
}

if (!isset($json->user_id)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "user_id required.";
    $model->publish();
}


//getting following user id by type
$following_user = 0;

if ($json->id_type == IDType::$USER_NAME) {
    $following_user = getUserIdByName($json->user_id);
} else if ($json->id_type == IDType::$USER_EMAIL) {
    $following_user = getUserIdByEmail($json->user_id);
} else if ($json->id_type == IDType::$USER_ID) {
    $following_user = $json->user_id;
}

if ($following_user == 0) {
    $model->err_code = ErrorCodes::$INVALID_VALUE;
    $model->msg = "invalid following user_id";
    $model->publish();
}


//check record
$result = DB::connect()->select("*")
    ->from("user_follow")->where()
    ->numberOf("followed_by", $user_id)->also()
    ->numberOf("user_id", $following_user)
    ->run();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while checking follow record. " . DB::connect()->getError();
    $model->publish();
}

if (mysqli_num_rows($result) == 0) {

    $result = DB::connect()->insertIn("user_follow")
        ->columnAsNumber("user_id", $following_user)
        ->columnAsNumber("followed_by", $user_id)
        ->save();

    if (!$result) {
        $model->err_code = ErrorCodes::$QUERY_FAILED;
        $model->msg = "failed while inserting data in user_follow table. " . DB::connect()->getError();
        $model->publish();
    }

    $model->status = 1;
    $model->data = "you are following.";
    $model->publish();
} else {

    $row = mysqli_fetch_object($result);
    $result = false;

    if ($row->following) {

        $result = DB::connect()->updateIn("user_follow")
            ->setNumberOf("following", 0)->where()
            ->numberOf("follow_id", $row->follow_id)->run();

        $model->data = array("following" => 0);
    } else {

        $result = DB::connect()->updateIn("user_follow")
            ->setNumberOf("following", 1)->where()
            ->numberOf("follow_id", $row->follow_id)->run();

        $model->data = array("following" => 1);
    }//if

    if (!$result) {
        $model->err_code = ErrorCodes::$QUERY_FAILED;
        $model->msg = "failed while inserting data in user_follow table. " . DB::connect()->getError();
        $model->publish();
    }

    $model->status = 1;
    $model->publish();

}//if