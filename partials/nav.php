<?php

function navItem($label, $url) {
    if(strncmp ($_SERVER['REQUEST_URI'], $url, strlen($url)) == 0) {
        return "<li class=\"active\"><a href=\"$url\">$label</a></li>";
    } else {
        return "<li><a href=\"$url\">$label</a></li>";
    }
}

?>

<nav class="nav-fixed">
    <div class="container">
        <a href="/" class="logo"></a>
        <div class="nav-expand" id="expand">
            <i class="fa fa-bars"></i>
            <i class="fa fa-close"></i>
        </div>
        <ul class="right-nav">
            <?=navItem('About', '/about')?>
            <?=navItem('People', '/people')?>
            <?=navItem('Updates', '/updates')?>
            <?=navItem('Projects', '/projects')?>
            <?=navItem('Events', '/events')?>
            <?=navItem('Actions', '/actions')?>
            <?=navItem('Get Involved!', '/involved')?>
        </ul>
        <div class="clearfix"></div>
    </div>
</nav>
