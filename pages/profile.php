<?php

if (!isset($_COOKIE["session"])) {
    header("Location: login.php");
    die();
}

include_once __DIR__ . '/../api/basic_funcs.php';

$user = getUserIdBySession($_COOKIE["session"]);
if ($user == 0) {
    header("Location: login.php");
    die();
}//if

$user_id = 0;

if (isset($_GET["id"]))
    $user_id = $_GET["id"];

$user_detail = getUserDetail($user_id);

if ($user_id == 0 || !$user_detail) {
    header("Location: invalid_profile.php");
    die();
}//if

$following = false;

include_once __DIR__ . "/../db/DB.php";

$result = DB::connect()->select("count(user_id), following")->from("user_follow")
    ->where()->numberOf("user_id", $user_id)->also()
    ->numberOf("followed_by", $user)->run();

$row = mysqli_fetch_row($result);
if ($row[0] > 0) {
    if ($row[1])
        $following = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $user_detail->user_name; ?></title>
    <link rel="stylesheet" href="../res/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../res/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<!--Header-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">Tweeter</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Notifications</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">My Tweets</a>
            </li>

        </ul>

    </div>


</nav>
<!--Header End-->

<!--Content Section-->
<div class="container" align="center">

    <div class="alert alert-secondary" role="alert">
        <h3 class="text-danger"><?php echo $user_detail->user_name; ?></h3>
        <?php if ($user != $user_id) { ?>
            <button onclick="follow(this, <?php echo $user_id; ?>)" type="button" class="btn btn-primary">
                <?php if ($following) echo "Unfollow";
                else echo "Follow"; ?>
            </button>
        <?php } ?>
    </div>


    <div id="wall" style="margin-top: 20px;">
    </div>
</div>
<!--Content Section End-->


<!--Dialog-->
<div class="modal fade" id="dialog_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialog_info_title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dialog_info_msg"></div>
        </div>
    </div>
</div>
<!--Dialog-->

<script src="../res/jquery.js"></script>
<script src="../res/popper.js"></script>
<script src="../res/bootstrap.js"></script>
<script src="../res/home.js"></script>

<script type="text/javascript" >
    init1(<?php echo $user_id; ?>);
</script>


</body>
</html>