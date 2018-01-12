<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:46 PM
 */

include_once 'base_api.php';

if (!isset($json->search)) {
    $model->err_code = ErrorCodes::$PARAM_MISSING;
    $model->msg = "search param reuired.";
    $model->publish();
}

if (empty($json->search)) {
    $model->err_code = ErrorCodes::$INVALID_VALUE;
    $model->msg = "search cannot be blank reuired.";
    $model->publish();
}


$result = DB::connect()
    ->select("*")
    ->from("user_detail")
    ->where()
    ->run(" user_name LIKE '%$json->search%'");

if (!$result) {
    $model->err_code = ErrorCodes::$QUERY_FAILED;
    $model->msg = "failed while searching in user_detail table: " . DB::connect()->getError();
    $model->publish();
}

$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

$data = $rows;

$model->status = 1;
$model->data = $data;
$model->publish();