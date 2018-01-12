<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 08/12/17
 * Time: 9:00 PM
 */
include_once 'base_api.php';


//sign up validation

if (!isset($json->user_name)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "user_name required.";
    $model->publish();
}

if (!isset($json->user_email)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "user_email required.";
    $model->publish();
}

if (!isset($json->user_password)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "user_password required.";
    $model->publish();
}

if (!isset($json->name)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "name required.";
    $model->publish();
}

if (!isset($json->user_city)) {

    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "user_city required.";
    $model->publish();
}


//save data in user login
$result = DB::connect()->insertIn("user_login")
    ->columnAsString("user_name", $json->user_name)
    ->columnAsString("user_email", $json->user_email)
    ->columnAsString("user_password", $json->user_password)
    ->save();


//check result
if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed when inserting in user_login. " . DB::connect()->getError();
    $model->publish();
}

//getting user id
$result = DB::connect()->select("user_id")
    ->from("user_login")
    ->where()
    ->stringOf("user_email", $json->user_email)
    ->run();

//check result
if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed when selecting user id. " . DB::connect()->getError();
    $model->publish();
}

//check result count
if (mysqli_num_rows($result) == 0) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "no row selected after user_detail insert operation.";
    die(json_encode($model));
}


$row = mysqli_fetch_object($result);

//insert in user detail
$result = DB::connect()->insertIn("user_detail")
    ->columnAsNumber("user_id", $row->user_id)
    ->columnAsString("user_name", $json->name)
    ->columnAsString("user_city", $json->user_city)
    ->save();

//insert in user follow
$result = DB::connect()->insertIn("user_follow")
    ->columnAsNumber("user_id", $row->user_id)
    ->columnAsString("followed_by", $row->user_id)
    ->save();

include_once 'login_func.php';

$user_detail = login($json->user_email, $json->user_password);

if (!$user_detail) {
    $model->err_code = ErrorCodes::$LOGIN_FAILED;
    $model->msg = "failed after sign up.";
    $model->publish();
}


$model->status = 1;
$model->data = $user_detail;
$model->publish();