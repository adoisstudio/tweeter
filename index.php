<?php

if (isset($_COOKIE["session"])) {

    include_once __DIR__ . '/api/basic_funcs.php';

    $user_id = getUserIdBySession($_COOKIE["session"]);
    //echo $user_id;

    if ($user_id != 0) {
        header("Location: pages/home.php");
        die();
    }

}//if

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tweeter</title>
</head>
<body>

<div align="center" style="margin-top: 300px;">

    <h1>Welcome to Tweeter</h1>

    <div align="center">

        <a href="pages/login.php" >Login</a> |
        <a href="pages/signup.php" >Sign Up</a>

    </div>

</div>


</body>
</html>