<?php

if (!isset($_COOKIE["session"])) {
    header("Location: login.php");
    die();
}

include_once __DIR__ . '/../api/basic_funcs.php';

$user_id = getUserIdBySession($_COOKIE["session"]);
$user_detail = getUserDetail($user_id);

if ($user_id == 0 || !$user_detail) {
    header("Location: login.php");
    die();
}//if

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

        </ul>

        <form class="form-inline my-2 my-lg-0 mr-auto" onsubmit="return search();">
            <input id="search_text" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <div class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/public/images/logo.png" height="26" width="26"/>&nbsp;&nbsp;
                        <?php echo $user_detail->user_name; ?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="setting.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="logout()" href="#">Logout</a>

                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!--Header End-->

<!--Content Section-->
<div class="container" align="center">


    <div style="margin-top: 20px;">

        <div id="searchBox" class="card bg-light mb-3" style="display:none; max-width: 42rem;">

            <div align="left" class="card-header">
                Search Result
                <button onclick="clearSearch();" class="float-right btn-outline-danger">Clear</button>
            </div>

            <div id="searchResult" class="card-body" align="left">

            </div>

        </div>


        <div class="card bg-light  mb-3" style="max-width: 42rem;">

            <div align="left" class="card-header">What's on your mind</div>

            <div class="card-body" align="left">
                <textarea id="tweet_text" type="text" class="form-control" aria-label="Default"
                          rows="4" placeholder="Write Tweet Here..."
                          aria-describedby="inputGroup-sizing-default"></textarea>

                <button type="button" onclick="tweet()" class="btn btn-outline-primary float-right"
                        style="margin-top: 10px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;&nbsp;
                </button>

            </div>

        </div>
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

<script type="text/javascript">
    init();
    setInterval("update()", 5000);
</script>

</body>
</html>