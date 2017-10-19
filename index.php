<!DOCTYPE html>
<html>
<?php require_once 'partials/head.php' ?>
<body>
    <?php require_once 'partials/nav.php'; ?>
    <style type="text/css">
        .update-item ol {
            font-size: 0.9rem;
        }
    </style>
    <main class="container landing">
        <section class="banner">
            <div class="content">
                <h1>Exciting new update is coming soon!</h1>
            </div>
        </section>
        <section class="row">
            <div class="col-lg-4">
                <h2>Latest Update</h2>
                <a class="update-item" href="/updates">
                    <div class="update-image" style="background-image: url('http://stugov.union.rpi.edu/studentgovernment/wp-content/uploads/2015/03/20140506_Banner_0001.jpg')">
                    </div>
                    <div class="update-content">
                        <h4>Subcommittees tasked with new project initiatives</h4>
                        <p class="logistics"></p>
                        <p>
                            This past semester was an exciting one for the Student Senate’s Student Life Committee! The committee, which...
                        </p>
                    </div>
                </a>
                <a class="btn btn-inverse pull-right" href="/updates">View All</a>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-4">
                <h2>Upcoming Events</h2>
                <a class="update-item" href="/events">
                    <div class="update-content" style="min-height: 0">
                        <h4>Senate Meeting</h4>
                        <p class="logistics">Monday, May 1, 2017 | 8 pm</p>
                    </div>
                </a>
                <a class="update-item" href="/updates">
                    <div class="update-content" style="min-height: 0">
                        <h4>Procedural Budgeting Forum</h4>
                        <p class="logistics">Wednesday, April 3, 2017 | 2 pm</p>
                    </div>
                </a>
                <a class="update-item" href="/updates">
                    <div class="update-content" style="min-height: 0">
                        <h4>Class of 2018 Council Meeting</h4>
                        <p class="logistics">Wednesday, April 3, 2017 | 8 pm</p>
                    </div>
                </a>
                <a class="update-item" href="/updates">
                    <div class="update-content" style="min-height: 0">
                        <h4>Executive Board Meeting</h4>
                        <p class="logistics">Thursday, May 4, 2017 | 7:30 pm</p>
                    </div>
                </a>
                <a class="btn btn-inverse pull-right" href="/events">View All</a>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-4">
                <h2>Recent Actions &amp; Legislation</h2>
                <?php
                    include_once 'partials/Parsedown.php';
                    $Parsedown = new Parsedown();


                    $url = "https://data.sg.rpi.edu/api/actions?count=3";
                    $data = json_decode(file_get_contents($url), true);

                    foreach($data as $entry) {
                        echo "<a class=\"update-item\" href=\"/actions?body=$entry[bodyUniqueId]&session=$entry[sessionUniqueId]&meeting=$entry[meetingNum]&action=$entry[actionNum]\">
                            <div class=\"update-content\">
                                <h4>" . $entry["description"] . "</h4>
                                <p class=\"logistics\"></p>
                                <p>
                                    " . substr($entry["text"], 0, 100) . "...
                                </p>
                            </div>
                        </a>";
                    }
                ?>
                <a class="btn btn-inverse pull-right" href="/actions">View All</a>
                <div class="clearfix"></div>
            </div>
        </section>
    </main>
    <?php require_once 'partials/footer.php' ?>
</body>
</html>
