<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php';

$uniqueId = $_GET['uniqueId'];
$bodyUniqueId = $_GET['bodyUniqueId'];

$members = Memberships::read([
    "bodyUniqueId" => $bodyUniqueId,
    "sessionUniqueId" => $uniqueId,
    "sort" => "name,-endDate"
]);
$otherSessions = Sessions::read([
    "bodyUniqueId" => $bodyUniqueId,
    "sort" => "-name"
]);

$sessionTitle = $members[0]['session']['name'];

function loadMembers($title, $session, $members, $officersOnly, $votingOnly) {
    $html = '<section class="row">';

    $html .= '<div class="col-xs-12"><h2>' . $title . '</h2></div>';

    foreach($members as $m) {
        if(!$session['active'] || $m['current']) {
            if($officersOnly && !$m['position']['officer']) {
                continue;
            } else if($votingOnly && !$m['position']['voting']) {
                continue;
            }

            if(isset($m['person']['image'])) {
                $image = $m['person']['image'];
            } else {
                $image = "//photos.sg.rpi.edu/headshot/$m[personRcsId]?bodyUniqueId=$session[bodyUniqueId]";
            }
            $personName = $m['person']['name'];

            $html .= "
                <div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">
                    <a class=\"person-item small\" href=\"/people/member_detail.php?rcsId=$m[personRcsId]\">
                        <div class=\"person-image\" " . ($image != '' ? "style=\"height: 186.65px; background-image: url('$image')\"" : "style=\"height: 186.65px\"") . "></div>
                        <div class=\"person-content\">
                            <h4>$personName</h4>
                            <p class=\"position\" style=\"font-size: 0.75rem;\">$m[name]</p>
                        </div>
                    </a>
                </div>
            ";
        }
    }

    return $html . '</section>';
}
?>

<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1 style="margin-bottom: 0;"><?=$sessionTitle ?></h1>
            </div>
        </section>
        <?=loadMembers('Officers', $members[0]['session'], $members, true, false) ?>
        <?=loadMembers('Voting Members', $members[0]['session'], $members, false, true) ?>
        <section class="row">
            <div class="col-xs-12"><h2>Other Sessions</h2></div>
            <?php
            foreach($otherSessions as $s) {
                if($s['uniqueId'] == $uniqueId) continue;

                echo "
                    <div class='col-lg-2 col-md-3 col-sm-4 col-xs-6'>
                        <a class='person-item small no-image' href='/people/session.php?bodyUniqueId=$bodyUniqueId&uniqueId=$s[uniqueId]'>
                            <div class='person-content'>
                                <h4>$s[name]</h4>
                            </div>
                        </a>
                    </div>
                ";
            }
            ?>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
