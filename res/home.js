/*
* home.js file content all code for making page dynamic
* */

var initiated = false;
var wall = null;
var templates = null;
var maxTweetId = 0;

var session = {session_id: readCookie("session")};

//Base functions
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function api(url, obj, callback) {
    console.log("REQUEST on url: " + url, obj);
    $.ajax({
        method: "POST",
        url: url,
        data: JSON.stringify(obj)
    }).done(function (data) {
        console.log("RESPONSE of url: " + url, data);
        callback(true, data);
    }).fail(function () {
        console.log("FAILED RESPONSE of url: " + url);
        callback(false, {});
    });
}//fetch

function init() {
    wall = $("#wall");
    api("templates.php", session, handleTemplates);
}//init

function init1(id) {
    wall = $("#wall");

    var data = {session_id: session.session_id, id: id};

    api("templates.php", session, function (success, json) {
        initiated = true;
        templates = json;

        api("../api/tweets.php", data, handleTweets);
    });
}//init1

function update() {

    if (!initiated) {
        init();
        return;
    }

    //calling updates api
    var data = {session_id: session.session_id, max_tweet_id: maxTweetId};
    api("../api/updates.php", data, handleUpdates);

}//update

function clearSearch() {
    $("#searchBox").hide();
    $("#search_text").val("");
    $("#searchResult").html("");
}

function search() {

    var text = document.getElementById("search_text").value;

    var data = {session_id: session.session_id, search: text};
    api("../api/search.php", data, function (success, json) {
        if (!success) return;

        if (json.status == 0) {
            clearSearch();
            return;
        }

        $("#searchResult").html("");
        var searchResult = $("#searchResult");

        for (var i = 0; i < json.data.length; i++) {

            var item = json.data[i];
            var template = templates.search;

            template = template.replace("{{{dp}}}", item.user_dp_url);
            template = template.replace("{{{id}}}", item.user_id);
            template = template.replace("{{{name}}}", item.user_name);
            template = template.replace("{{{city}}}", item.user_city);

            searchResult.append(template);
        }//for

        $("#searchBox").show();
    });

    return false;
}//search

function handleTemplates(success, json) {

    initiated = true;
    templates = json;

    api("../api/tweets.php", session, handleTweets);
}//handle template

function handleUpdates(success, json) {

    if (!success || json.status == 0)
        return;

    for (var i = 0; i < json.data.tweets.length; i++) {
        appendTweet(json.data.tweets[i], true);
    }//for


}//handle updates

function handleTweets(success, json) {
    console.log("Tweets")
    console.log(json);

    for (var i = 0; i < json.data.length; i++) {
        appendTweet(json.data[i], false);
    }//for

}//handle tweets

function appendTweet(data, toTop) {

    if (data.post_id > maxTweetId)
        maxTweetId = data.post_id;

    var template = templates.tweet;

    template = template.replace("{{{tweeter_dp}}}", data.user_dp_url);
    template = template.replace("{{{id}}}", data.user_id);
    template = template.replace("{{{tweeter}}}", data.user_name);

    data.post_text = data.post_text.replace(/\n/g, "<br>");

    template = template.replace("{{{tweet}}}", data.post_text);

    if (data.liking == 0) {
        template = template.replace("{{{like_class}}}", "class=\"text-primary like_btn\"");
        template = template.replace("{{{like}}}", "Like");
    } else {
        template = template.replace("{{{like_class}}}", "class=\"text-danger like_btn\"");
        template = template.replace("{{{like}}}", "Unlike");
    }


    template = template.replace("{{{tweet_id}}}", data.post_id);
    template = template.replace("{{{tweet_id}}}", data.post_id);
    template = template.replace("{{{tweet_id}}}", data.post_id);
    template = template.replace("{{{tweet_id}}}", data.post_id);
    template = template.replace("{{{tweet_id}}}", data.post_id);
    template = template.replace("{{{tweet_id}}}", data.post_id);
    template = template.replace("{{{time}}}", data.created_on);

    if (toTop)
        wall.prepend(template);
    else
        wall.append(template);

}//append tweet

function tweet() {

    var text = $("#tweet_text");
    var data = {
        session_id: session.session_id,
        post_type: 1,
        post_text: text.val(),
        img_id: 0
    };

    api("../api/tweet.php", data, function (success, json) {

        if (!success) {
            showInfoDialog("Failed", "Please retry.");
            return;
        }

        if (data.status == 0) {
            showInfoDialog("Failed", data.msg);
            return;
        }

        appendTweet(json.data, true);

        text.val("");
        showInfoDialog("SUCCESS", "Tweeted Successfully");

    });

}//tweet

function follow(link, user_id) {

    var data = {session_id: session.session_id, id_type: 0, user_id: user_id};

    api("../api/follow.php", data, function (success, data) {

        if (!success) {
            showInfoDialog("Follow/Unfollow Failed", "Please retry.");
            return;
        }

        if (data.status == 0) {
            showInfoDialog("Follow/Unfollow Failed", data.msg);
            return;
        }

        if (data.data.following == 0) {
            link.innerHTML = ("Follow");
        } else {
            link.innerHTML = ("Unfollow");
        }

    });

}//like

function like(link, post_id) {
    console.log("liking: " + post_id);

    var data = {session_id: session.session_id, post_id: post_id};

    api("../api/like.php", data, function (success, data) {

        if (!success) {
            showInfoDialog("Like/Unlike Failed", "Please retry.");
            return;
        }

        if (data.status == 0) {
            showInfoDialog("Like/Unlike Failed", data.msg);
            return;
        }

        if (data.data.liking == 0) {
            link.innerHTML = ("Like");
            $(link).addClass("text-primary");
            $(link).removeClass("text-danger");
        } else {
            link.innerHTML = ("Unlike");
            $(link).addClass("text-danger");
            $(link).removeClass("text-primary");
        }

    });

}//like

function share(post_id) {
    console.log("sharing: " + post_id);
}//share

function showComment(id) {
    $("#comments" + id).toggle();
    $("#search_text" + id).focus();
    updateComments(id);
}//comment


function comment(id) {

    var text = $("#search_text" + id).val();
    var data = {session_id: session.session_id, post_id: id, comment: text};

    api("../api/comment.php", data, function (success, json) {

        if (!success) return;

        if (json.status == 0)
            return;

        $("#search_text" + id).val("");

        updateComments(id);

    });

    return false;
}//comment

function updateComments(id) {

    var list = $("#comments_list" + id);
    var data = {session_id: session.session_id, post_id: id};

    api("../api/comments.php", data, function (success, json) {

        if (!success) return;

        if (json.status == 0)
            return;

        list.html("");
        for (var i = 0; i < json.data.length; i++) {

            var template = templates.comment;
            var item = json.data[i];

            template = template.replace("{{{dp}}}", item.user_dp_url);
            template = template.replace("{{{id}}}", item.user_id);
            template = template.replace("{{{name}}}", item.user_name);
            template = template.replace("{{{comment}}}", item.comment);
            template = template.replace("{{{time}}}", item.commented_on);


            list.append(template);
        }//for

    });

}//update comments

//Page functions
function logout() {


    $.ajax({
        method: "POST",
        url: "../api/logout.php",
        data: JSON.stringify(session)
    }).done(function (data) {

        console.log(data);

        if (data.status == 1) {
            window.location.href = "login.php";
        }

    });

}//logout

function showInfoDialog(title, msg) {

    $("#dialog_info_title").html(title);
    $("#dialog_info_msg").html(msg);
    $("#dialog_info").modal("show");

}