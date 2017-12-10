<?php
include_once '../partials/Parsedown.php';
include_once '../partials/api.php';

$Parsedown = new Parsedown();

function constructUrlParams($page) {
    $urlParams = '';

    foreach($_GET as $key => $val) {
        if($key == 'page' && $page == 0) {
            continue;
        }

        $urlParams .= (strlen($urlParams) == 0) ? '?' : '&';
        if($key == 'page' && isset($page)) {
            $urlParams .= 'page=' . $page;
        } else {
            $urlParams .= "$key=" . $_GET[$key];
        }
    }

    if(!isset($_GET['page']) && isset($page) && $page != 0) {
        $urlParams .= (strlen($urlParams) == 0) ? '?' : '&';
        $urlParams .= 'page=' . $page;
    }

    return $urlParams;
}

$actionsParams = '';

if(isset($_GET['body'])) {
    $actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';
    $actionsParams .= "bodyUniqueId=$_GET[body]";
}

if(isset($_GET['session'])) {
    $actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';
    $actionsParams .= "sessionUniqueId=$_GET[session]";
}

if(isset($_GET['meeting'])) {
    $actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';
    $actionsParams .= "meetingNum=$_GET[meeting]";
}

if(isset($_GET['action'])) {
    $actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';
    $actionsParams .= "actionNum=$_GET[action]";
}

if(isset($_GET['q'])) {
    $actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';
    $actionsParams .= "q=$_GET[q]";
}

if(isset($_GET['page'])) {
    $actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';

    if($_GET['page'] <= 0) {
        header('Location: /actions' . constructUrlParams(0));
        exit;
    }

    $currentPage = $_GET['page'];

    $actionsParams .= "page=$currentPage";
} else {
    $currentPage = 0;
}

if(isset($_GET['count'])) {
    $numPerPage = $_GET[count];
} else {
    $numPerPage = 10;
}

$actionsParams .= (strlen($actionsParams) == 0) ? '?' : '&';
$actionsParams .= "count=" . $numPerPage;



$data = json_decode(file_get_contents($API_BASE . "api/actions" . $actionsParams), true);

foreach($http_response_header as $h) {
    $header = explode(": ", $h, 2);
    if($header[0] == 'Content-Range') {
        $contentRange = explode(" ", $header[1], 2)[1];
        $startingIndex = explode("-", $contentRange, 2)[0];
        $totalActionsCount = explode("/", $contentRange, 2)[1];
        $numPages = (int)ceil((float)$totalActionsCount / (float)$numPerPage);

        if($startingIndex >= $totalActionsCount && $totalActionsCount > 0) {
            header('Location: /actions' . constructUrlParams(($numPages - 1)));
            exit;
        }
    }
}

$activeSessions = json_decode(file_get_contents($API_BASE . "api/sessions?active=true"), true);
?>
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php' ?>
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
                    if(count($data) == 0) {
                        echo "<h3>No actions were found!</h3>";
                    } else {
                        $i = 0;
                        foreach($data as $entry) {
                            if($i > 0) {
                                echo "<hr />";
                            }

                            echo "<article>";
                            echo "<h2>" . $entry["description"] . "</h2>";
                            echo "<p class=\"small text-muted\">" . $entry["meeting"]["displayDate"] . " | Action ID: <strong>" . $entry["actionIndicator"] . "</strong></p>";
                            echo "<p class=\"lead\">" . $Parsedown->text($entry["text"]) . "</p>";

                            echo "<p class=\"lead\"><em>So moved by ";
                            if(isset($entry["movingSubbodyUniqueId"])) {
                                echo 'the ' . $entry["subbody"]["name"] . '.';
                            } else if(isset($entry['movingOtherEntity'])) {
                                echo 'the ' . $entry["movingOtherEntity"] . '.';
                            } else {
                                $mover = $entry["movingMember"]["person"];
                                $seconder = $entry["secondingMember"]["person"];
                                echo "<a href=\"/people/member_detail.php?rcsId=$mover[rcsId]\">$mover[name]</a> and seconded by <a href=\"/people/member_detail.php?rcsId=$seconder[rcsId]\">$seconder[name]</a>.";
                            }
                            echo "</em></p>";

                            if($entry["status"] != 'Pending') {
                                echo "<p><strong>" . $entry["status"] . " by a vote of " . $entry["votesFor"] . "-" . $entry["votesAgainst"] . "-" . $entry["abstentions"] . ".</strong></p>";
                            }
                            echo "</article>";

                            $i++;
                        }
                    }
                ?>
                <?php
                if(!isset($_GET['action'])) {
                    echo '<hr>';

                    echo '<p class="text-center">';

                    echo '<a class="btn btn-inverse pull-left' . ($currentPage == 0 ? ' disabled" ' : '" ') .
                        ($currentPage > 0 ? 'href="/actions' . constructUrlParams(($currentPage - 1)) . '">' : '>') .
                        '< Previous Page</a>';

                    echo '<a class="btn btn-inverse pull-right' . ($currentPage == ($numPages - 1) ? ' disabled" ' : '" ') .
                        ($currentPage < $numPages ? 'href="/actions' . constructUrlParams(($currentPage + 1)) . '">' : '>') .
                        'Next Page ></a>';

                    echo '<span class="btn-label">Page ' . ($currentPage + 1) . ' of ' . $numPages . '</span>';

                    echo '</p>';
                }
                ?>
            </div>
            <?php
                $data = json_decode(file_get_contents($API_BASE . "api/bodies"), true);

                $i = 0;

                $active = null;

                if(isset($data)) {
                    echo '<div class="col-md-3 col-md-offset-1 sidebar hidden-sm hidden-xs">';

                    echo '<form method="get" action="/actions">';

                    if(isset($_GET['body'])) {
                        echo '<input name="body" type="hidden" value="' . $_GET['body'] . '">';
                    }

                    if(isset($_GET['session'])) {
                        echo '<input name="session" type="hidden" value="' . $_GET['session'] . '">';
                    }

                    echo '<input name="q" type="text" placeholder="Search actions" value="' . (isset($_GET['q']) ? $_GET['q'] : '' ) . '">';

                    echo '<input type="submit" class="btn btn-inverse pull-right" value="Search">';

                    echo '<div class="clearfix"></div>';

                    echo '</form>';

                    echo '<hr><h3>Filter by body</h3>';

                    echo '<a class="' . (!isset($_GET['body']) ? 'active' : '') . '" href="/actions"><strong>All bodies</strong></a>';

                    foreach($data as $entry) {
                        $classes = '';

                        if (isset($_GET['body']) && $_GET['body'] == $entry['uniqueId']) {
                            $active = json_decode(json_encode($entry), true);
                            $classes .= 'class="active"';
                        }

                        echo "<a " . $classes . "href=\"/actions?body=$entry[uniqueId]\">$entry[name]</a>";
                    }

                    echo "<hr><h3>Filter by active session</h3>";

                    foreach ($activeSessions as $session) {
                        $classes = '';

                        if (isset($_GET['session']) && $_GET['session'] == $session['uniqueId'] && $_GET['body'] == $session['bodyUniqueId']) {
                            $classes .= 'class="active"';
                        }

                        echo "<a " . $classes . "href='/actions?body=$session[bodyUniqueId]&session=$session[uniqueId]'>$session[name]</a>";
                    }

                    if(isset($active) && count($active['sessions']) > 0) {
                        echo "<hr><h3>Filter by $active[name] session</h3>";

                        if (isset($_GET['body']) && $_GET['body'] == $entry['uniqueId']) {
                            $active = json_decode(json_encode($entry), true);
                            $classes .= 'class="active"';
                        }

                        echo "<a class=\"" . (!isset($_GET['session']) ? 'active' : '') . "\" href='/actions?body=$active[uniqueId]'>All sessions</a>";

                        foreach($active['sessions'] as $session) {
                            $classes = '';

                            if (isset($_GET['session']) && $_GET['session'] == $session['uniqueId']) {
                                $classes .= 'class="active"';
                            }

                            echo "<a " . $classes . "href='/actions?body=$active[uniqueId]&session=$session[uniqueId]'>$session[name]</a>";
                        }
                    } else {

                    }

                    echo '</div>';
                }
            ?>
        </div>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
