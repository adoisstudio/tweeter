<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 08/12/17
 * Time: 8:44 PM
 */
session_start();

//including all required common files
include_once 'models.php';
include_once 'codes.php';
include_once 'basic_funcs.php';
include_once '../db/DB.php';

//writing header for content type
header("Content-Type: application/json");

$model = new BaseModel();

$json_data = file_get_contents("php://input");

$json = json_decode($json_data);

if (json_last_error() != JSON_ERROR_NONE) {

    $model->err_code = ErrorCodes::$JSON_MISS_FORMATTED;
    $model->msg = "json decoding failed";
    $model->data = $json_data;
    $model->publish();

}

//check if session_id exist
$user_id = 0;

if (isset($json->session_id)) {

    $result = DB::connect()
        ->select("*")
        ->from("session_master")
        ->where()
        ->stringOf("session_id", $json->session_id)
        ->also()
        ->numberOf("expired", 0)
        ->run();

    if (!$result) {
        $model->err_code = ErrorCodes::$QUERY_FAILED;
        $model->msg = "failed when validating session_id " . DB::connect()->getError();
        $model->publish();
    }

    if (mysqli_num_rows($result) == 0) {
        $model->err_code = ErrorCodes::$INVALID_SESSION_ID;
        $model->msg = "invalid session id.";
        $model->publish();
    }

    $row = mysqli_fetch_object($result);

    $user_id = $row->user_id;

}//if