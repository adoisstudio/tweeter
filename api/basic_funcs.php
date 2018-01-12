<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 18/12/17
 * Time: 7:54 PM
 */

function getUserIdByEmail($user_email)
{

    include_once __DIR__ . '/../db/DB.php';

    $result = DB::connect()->select("user_id")
        ->from("user_login")->where()
        ->stringOf("user_email", $user_email)
        ->run();

    if (!$result) {
        include_once 'models.php';
        (new BaseModel("query failed in getUserIdByEmail" . DB::connect()->getError()
        ))->publish();
    }

    if (mysqli_num_rows($result) == 0)
        return 0;

    $row = mysqli_fetch_row($result);
    return $row[0];

}//get user id by email

function getUserIdByName($user_name)
{

    include_once __DIR__ . '/../db/DB.php';

    $result = DB::connect()->select("user_id")
        ->from("user_login")->where()
        ->stringOf("user_name", $user_name)
        ->run();

    if (!$result) {
        include_once 'models.php';
        (new BaseModel("query failed in getUserIdByName" . DB::connect()->getError()
        ))->publish();
    }

    if (mysqli_num_rows($result) == 0)
        return 0;

    $row = mysqli_fetch_row($result);
    return $row[0];

}//get user id by name

function getUserIdBySession($session)
{
    include_once __DIR__ . '/../db/DB.php';

    $result = DB::connect()
        ->select("*")
        ->from("session_master")
        ->where()
        ->stringOf("session_id", $session)
        ->also()
        ->numberOf("expired", 0)
        ->run();

    if (!$result) {
        return 0;
    }

    if (mysqli_num_rows($result) == 0) {
        return 0;
    }

    $row = mysqli_fetch_object($result);

    return $row->user_id;
}

function getUserDetail($user_id)
{
    include_once __DIR__ . '/../db/DB.php';

    $result = DB::connect()
        ->select("user_login.user_email, user_detail.*")
        ->from("user_login INNER JOIN user_detail ON user_login.user_id  = user_detail.user_id ")
        ->where()
        ->numberOf("user_login.user_id", $user_id)
        ->run();

    if (!$result) {
        return false;
    }

    if (mysqli_num_rows($result) == 0) {
        return false;
    }

    $row = mysqli_fetch_object($result);

    return $row;
}

function isPostExist($post_id)
{
    include_once '../db/DB.php';

    $result = DB::connect()->select("count(post_id)")
        ->from("user_post")->where()
        ->numberOf("post_id", $post_id)
        ->run();

    if (!$result) {
        include_once 'models.php';
        (new BaseModel("query failed in isPostExist" . DB::connect()->getError()
        ))->publish();
    }

    $row = mysqli_fetch_row($result);

    if ($row[0] == 0)
        return false;

    return true;
}//is post exist
