<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <style type="text/css">
        /* I know this is bad and should not be here. It's short term, don't judge! */

        a {
            color: #c40000;
        }
        ol li ol {
            list-style-type: lower-alpha;
        }
    </style>
    <main class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Actions</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php
                    include_once '../partials/Parsedown.php';
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

                    foreach($data["feed"]["entry"] as $entry) {
                        if($entry["gsx\$status"]["\$t"] != "Not Yet Moved") {
                            echo "<article><h2>" . $entry["gsx\$descriptor"]["\$t"] . "</h2>
                                <p class=\"small text-muted\">" . $entry["gsx\$date"]["\$t"] . " | Legislation ID: <strong>S.48." . $entry["gsx\$gbm"]["\$t"] . "." . $entry["gsx\$motion"]["\$t"] . "</strong></p>
                                <p class=\"lead\">" . $Parsedown->text($entry["gsx\$motiontext"]["\$t"]) . "</p>
                                <p class=\"lead\"><em>
                                    So moved by " . $entry["gsx\$movedby"]["\$t"] . ",
                                    and seconded by " . $entry["gsx\$secondedby"]["\$t"] . ".
                                </em></p>
                                <p><strong>" . $entry["gsx\$status"]["\$t"] . " by a vote of " . $entry["gsx\$votesfor"]["\$t"]
                                    . "-" . $entry["gsx\$votesagainst"]["\$t"] . "-" . $entry["gsx\$abstentions"]["\$t"] . ".</p></strong>
                            </article>
                            <hr />";
                        }
                    }
                ?>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <h3>Filter by body</h3>
                <ul>
                    <li>
                        <a href=""><strong>All</strong></a>
                    </li>
                    <li>
                        <a href="">Senate</a>
                    </li>
                    <li>
                        <a href="">Executive Board</a>
                    </li>
                    <li>
                        <a href="">Judicial Board</a>
                    </li>
                    <li>
                        <a href="">Undergraduate Council</a>
                    </li>
                    <li>
                        <a href="">Graduate Council</a>
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
