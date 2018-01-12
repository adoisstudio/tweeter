<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:46 PM
 */

include_once 'base_api.php';

$result = DB::connect()->updateIn("session_master")
    ->setNumberOf("expired", 1)->where()
    ->numberOf("user_id", user_id)->run();

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while login in session_master table. " . DB::connect()->getError();
    $model->publish();
}

$model->status = 1;
$model->msg = "Logged Out $session_id";
$model->publish();
