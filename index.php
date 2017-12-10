<?php
include_once 'partials/Parsedown.php';
include_once 'partials/api.php';

date_default_timezone_set('America/New_York');

?>
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
            <a class="content" href="/about">
                <h1>By the students, for the students.</h1>
            </a>
        </section>
        <section class="row">
            <div class="col-lg-4">
                <h2>Latest Update</h2>
                <a class="update-item" href="/updates">
                    <div class="update-image" style="background-image: url('//sg.rpi.edu/studentgovernment/wp-content/uploads/2015/03/20140506_Banner_0001.jpg')">
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
                <?php
                    $meetings = Meetings::read([
                        'sort' => "date"
                    ]);

                    $displayed = 0;

                    foreach($meetings as $m) {
                        if($displayed >= 3) break;
                        if($m['date'] >= date('Y-m-d')) {
                            echo "<div class='update-item' href='/events'>";
                            echo "    <div class='update-content' style='min-height: 0'>";
                            echo "         <h4>" . $m['session']['name'] . " &ndash; Meeting #$m[meetingNum]</h4>";
                            echo "         <p class='logistics'>$m[displayDate]</p>";
                            echo "    </div>";
                            echo "</div>";

                            $displayed++;
                        }
                    }

                    if($displayed == 0) {
                        echo "<p><em>No events are upcoming!</em></p>";
                    }
                ?>
                <a class="btn btn-inverse pull-right" href="/events">View All</a>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-4">
                <h2>Recent Actions &amp; Legislation</h2>
                <?php
                    $Parsedown = new Parsedown();
                    $actions = Actions::read([
                        "count" => "3"
                    ]);

                    foreach($actions as $entry) {
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
