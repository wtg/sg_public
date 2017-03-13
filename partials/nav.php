<?php

function navItem($label, $url) {
    if(strncmp ($_SERVER['REQUEST_URI'], $url, strlen($url)) == 0) {
        return "<li class=\"active\"><a>$label</a></li>";
    } else {
        return "<li><a href=\"$url\">$label</a></li>";
    }
}

?>

<div class="fixed inverse">
    <header class="container">
        <ul class="right-nav">
            <?=navItem('About', '/about')?>
            <?=navItem('People', '/people')?>
            <?=navItem('Updates', '/updates')?>
            <?=navItem('Projects', '/projects')?>
            <?=navItem('Events', '/events')?>
            <?=navItem('Actions', '/actions')?>
            <?=navItem('Get Involved!', '/involved')?>
        </ul>
        <a href="/" class="logo"></a>
    </header>
</div>
