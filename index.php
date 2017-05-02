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
                <p>Bureaucracy bureaucracy bureaucracy bureaucracy bureaucracy bureaucracy bureaucracy.</p>
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
            </div>
            <div class="col-lg-4">
                <h2>Upcoming Events</h2>
                <a class="update-item" href="/updates">
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
            </div>
            <div class="col-lg-4">
                <h2>Recent Actions &amp; Legislation</h2>
                <?php
                    include_once 'partials/Parsedown.php';
                    $Parsedown = new Parsedown();


                    $url = "https://spreadsheets.google.com/feeds/list/1WBiEutYCz-EZn1SfJMC3SCGuqmSS9Esgj_V_sZR06Ho/od6/public/values?alt=json";
                    $data = json_decode(file_get_contents($url), true);

                    usort($data["feed"]["entry"], function ($item1, $item2) {
                        if ($item1["gsx\$date"]["\$t"] == $item2["gsx\$date"]["\$t"]) {
                            if ($item1["gsx\$motion"]["\$t"] == $item2["gsx\$motion"]["\$t"]) return 0;
                            return $item1["gsx\$motion"]["\$t"] < $item2["gsx\$motion"]["\$t"] ? 1 : -1;
                        }
                        return $item1["gsx\$date"]["\$t"] < $item2["gsx\$date"]["\$t"] ? 1 : -1;
                    });

                    $i = 0;
                    foreach($data["feed"]["entry"] as $entry) {
                        if($i >= 3) break;
                        if($entry["gsx\$status"]["\$t"] != "Not Yet Moved") {
                            echo "<a class=\"update-item\" href=\"/actions\">
                                <div class=\"update-content\">
                                    <h4>" . $entry["gsx\$descriptor"]["\$t"] . "</h4>
                                    <p class=\"logistics\"></p>
                                    <p>
                                        " . substr($entry["gsx\$motiontext"]["\$t"], 0, 100) . "
                                    </p>
                                </div>
                            </a>";
                            // echo "<article><h2>"  "</h2>
                            //     <p class=\"small text-muted\">" . $entry["gsx\$date"]["\$t"] . " | Legislation ID: <strong>S.48." . $entry["gsx\$gbm"]["\$t"] . "." . $entry["gsx\$motion"]["\$t"] . "</strong></p>
                            //     <p class=\"lead\">" .  . "</p>
                            //     <p class=\"lead\"><em>
                            //         So moved by " . $entry["gsx\$movedby"]["\$t"] . ",
                            //         and seconded by " . $entry["gsx\$secondedby"]["\$t"] . ".
                            //     </em></p>
                            //     <p><strong>" . $entry["gsx\$status"]["\$t"] . " by a vote of " . $entry["gsx\$votesfor"]["\$t"]
                            //         . "-" . $entry["gsx\$votesagainst"]["\$t"] . "-" . $entry["gsx\$abstentions"]["\$t"] . ".</p></strong>
                            // </article>
                            // <hr />";

                            $i++;
                        }
                    }
                ?>
            </div>
        </section>
    </main>
    <?php require_once 'partials/footer.php' ?>
</body>
</html>
