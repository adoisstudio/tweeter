<?php
/**
 * Created by PhpStorm.
 * User: amitkumar
 * Date: 08/12/17
 * Time: 1:27 PM
 */

class BaseModel
{
    public $status = 0;
    public $err_code = "";
    public $msg = "";
    public $data = null;

    public function __construct($message = "", $err_code = "")
    {
        $this->msg = $message;
        $this->err_code = $err_code;
    }

    public function publish()
    {
        die(json_encode($this));
    }

}//base model

class LoginModel
{
    public $session_id = "";
    public $user_id = 0;
    public $user_name = "";
    public $email = "";
    public $name = "";
    public $city = "";
}//login model