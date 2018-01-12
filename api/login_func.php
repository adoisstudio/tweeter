<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 09/12/17
 * Time: 11:49 PM
 */

function login($email, $password)
{

    include_once '../db/DB.php';

    $result = DB::connect()->select("user_id, user_name, user_email")
        ->from("user_login")->where()
        ->stringOf("user_email", $email)
        ->also()
        ->stringOf("user_password", $password)
        ->run();


    if (!$result) {
        return false;
    }

    if (mysqli_num_rows($result) == 0) {
        return false;
    }


    include_once 'models.php';

    $row = mysqli_fetch_object($result);


    $loginModel = new LoginModel();

    $loginModel->session_id = getSessionId($row->user_id);

    $loginModel->user_id = $row->user_id;
    $loginModel->email = $row->user_email;
    $loginModel->user_name = $row->user_name;


    //fetching user details
    $result = DB::connect()->select("*")
        ->from("user_detail")
        ->where()
        ->numberOf("user_id", $row->user_id)
        ->run();

    if (!$result) {
        return false;
    }

    if (mysqli_num_rows($result) == 0) {
        return false;
    }

    $row = mysqli_fetch_object($result);

    $loginModel->name = $row->user_name;
    $loginModel->city = $row->user_city;

    setcookie("session", $loginModel->session_id, time() + 86400);

    return $loginModel;
}

function getSessionId($user_id)
{

    $session_id = getRandomString();

    DB::connect()->updateIn("session_master")
        ->setNumberOf("expired", 1)
        ->where()->numberOf("user_id", $user_id)
        ->run();

    $result = DB::connect()->insertIn("session_master")
        ->columnAsString("session_id", $session_id)
        ->columnAsNumber("user_id", $user_id)
        ->save();

    if (!$result)
        return "null";


    return $session_id;
}//session

function getRandomString($length = 50)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}//random string