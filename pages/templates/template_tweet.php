<div class="card bg-light mb-3" style="max-width: 42rem;">

    <div class="card-header" align="left">
        <img src="{{{tweeter_dp}}}" height="30">&nbsp;&nbsp;
        <a class="text-dark" href="profile.php?id={{{id}}}">{{{tweeter}}}</a>
    </div>

    <div class="card-body text-dark">
        <p class="card-text" align="left">{{{tweet}}}</p>
    </div>

    <div class="card-footer bg-transparent" align="left">

        <span {{{like_class}}} onclick="like(this, {{{tweet_id}}})">{{{like}}}</span>&nbsp;&nbsp;&nbsp;
        <span class="like_btn text-primary" onclick="showComment({{{tweet_id}}})">Comment</span>&nbsp;&nbsp;&nbsp;

        <span class="float-right">{{{time}}}</span>
    </div>

    <div id="comments{{{tweet_id}}}" class="card-footer bg-transparent" style="display: none;" align="left">
        <div id="comments_list{{{tweet_id}}}">
        </div>

        <form class="form my-2 my-lg-0 mr-auto" onsubmit="return comment({{{tweet_id}}});">
            <input id="search_text{{{tweet_id}}}" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>

    </div>

</div><br>