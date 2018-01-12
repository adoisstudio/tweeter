<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 08/12/17
 * Time: 9:00 PM
 */
include_once 'base_api.php';

//login api need user_email and password params
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


include_once 'login_func.php';

$user_detail = login($json->user_email, $json->user_password);

if (!$user_detail) {
    $model->err_code = ErrorCodes::$LOGIN_FAILED;
    $model->msg = "invalid email or password";
    $model->publish();
}

$model->status = 1;
$model->data = $user_detail;
$model->publish();