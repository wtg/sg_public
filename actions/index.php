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
        article p {
            font-size: 1.25rem;
        }
        article h2 {
            margin-top: 0rem;
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

                    $params = '';

                    if(isset($_GET['body'])) {
                        $params .= (strlen($params) == 0) ? '?' : '&';
                        $params .= "bodyUniqueId=$_GET[body]";
                    }

                    if(isset($_GET['session'])) {
                        $params .= (strlen($params) == 0) ? '?' : '&';
                        $params .= "sessionUniqueId=$_GET[session]";
                    }

                    if(isset($_GET['meeting'])) {
                        $params .= (strlen($params) == 0) ? '?' : '&';
                        $params .= "meetingNum=$_GET[meeting]";
                    }

                    if(isset($_GET['action'])) {
                        $params .= (strlen($params) == 0) ? '?' : '&';
                        $params .= "actionNum=$_GET[action]";
                    }

                    $url = "http://sgdata.etz.io/api/actions/" . $params;
                    $data = json_decode(file_get_contents($url), true);

                    if(count($data) == 0) {
                        echo "<h3>No actions were found!</h3>";
                    }

                    foreach($data as $entry) {
                        echo "<article><h2>" . $entry["description"] . "</h2>
                            <p class=\"small text-muted\">" . $entry["meeting"]["date"] . " | Action ID: <strong>" . $entry["actionIndicator"] . "</strong></p>
                            <p class=\"lead\">" . $Parsedown->text($entry["text"]) . "</p>
                            <p class=\"lead\"><em>
                                So moved by " . (isset($entry["movingSubbodyUniqueId"]) ? ('the ' . $entry["movingSubbody"]["name"]) : $entry["movingMemberId"]) .
                                (isset($entry["movingSubbodyUniqueId"]) ? "" : (", and seconded by " . $entry["secondingMemberId"])) . ".
                            </em></p>
                            <p><strong>" . $entry["status"] . " by a vote of " . $entry["votesFor"]
                                . "-" . $entry["votesAgainst"] . "-" . $entry["abstentions"] . ".</p></strong>
                        </article>
                        <hr />";
                    }

                    // if(count($data))
                ?>
                <!-- <div>

                    <p>
                        <button class="btn btn-default pull-left" disabled>< Previous Page</button>
                        <button class="btn btn-default pull-right" disabled>Next Page ></button>
                    </p>
                </div> -->
            </div>
            <div class="col-md-3 col-md-offset-1">
                <h3>Filter by body</h3>
                <ul>
                    <li>
                        <a href="/actions"><strong>All bodies</strong></a>
                    </li>
                    <?php
                        $url = "http://sgdata.etz.io/api/bodies";
                        $data = json_decode(file_get_contents($url), true);

                        foreach($data as $entry) {
                            echo "<li style=\"margin-top: 0.7rem\"><a href=\"/actions?body=$entry[uniqueId]\">$entry[name]</a>";

                            if(count($entry['sessions']) > 0) {
                                echo "<ul>";
                                
                                foreach($entry['sessions'] as $session) {
                                    echo "<li style=\"font-size: 1.05rem\"><a href=\"/actions?body=$entry[uniqueId]&session=$session[uniqueId]\">$session[name]</a></li>";
                                }
                                echo "</ul>";
                            }

                            echo "</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
