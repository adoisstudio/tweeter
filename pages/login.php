<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="../res/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../res/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>


<!--Content Section-->
<div class="container" align="center">


    <div id="wall" style="margin-top: 100px;">

        <h1>Welcome to Tweeter</h1><br><br><br>

        <div class="card bg-light border-secondary mb-3" align="center" style="max-width: 340px;">

            <div class="card-header">Login</div>


            <div align="center" style="margin-top: 40px; max-width: 300px;">

                <input type="text" class="form-control" id="email" placeholder="Email" aria-label="Username"
                       aria-describedby="basic-addon1">

                <input type="password" class="form-control" id="password" placeholder="Password" aria-label="Username"
                       aria-describedby="basic-addon1" style="margin-top: 10px;">

                <button type="button" class="btn btn-outline-primary" style="margin-top: 15px;" onclick="login();">
                    &nbsp;&nbsp;Login&nbsp;&nbsp;
                </button>
                <br><br>

                <a href="signup.php">Not member yet. Sign Up here.</a>
                <br><br>
            </div>
        </div>
        <br>


    </div>


</div>
<!--Content Section End-->


<script type="text/javascript">

    function login() {
        var email = document.getElementById("email");
        var password = document.getElementById("password");

        var data = {user_email: email.value, user_password: password.value};
        console.log("sending: " + JSON.stringify(data));

        var http = new XMLHttpRequest();

        http.onreadystatechange = function () {

            if (this.readyState == 4 && this.status == 200) {

                var json = JSON.parse(this.responseText);
                console.log(json);

                if (json.status == 1) {
                    setCookie("session", json.data.session_id, 30);
                    window.location.href = "home.php";
                } else {
                    setCookie("session", "", 0);
                    alert("Login Failed: " + json.msg);
                }
            }//if

        }//

        http.open("POST", "../api/login.php", true);
        http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        http.send(JSON.stringify(data));

    }//login

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

</script>
<script src="../res/jquery.js"></script>
<script src="../res/popper.js"></script>
<script src="../res/bootstrap.js"></script>
</body>
</html>