<?php
    $uniqueId = $_GET['uniqueId'];
    $bodyUniqueId = $_GET['bodyUniqueId'];

    $members = json_decode(file_get_contents("https://data.sg.rpi.edu/api/memberships?bodyUniqueId=$bodyUniqueId&sessionUniqueId=$uniqueId&sort=name,-endDate"), true);

    $sessionTitle = $members[0]['session']['name'];

    function loadMembers($title, $members, $officersOnly, $votingOnly) {
        $html = '<section class="row">';

        $html .= '<div class="col-xs-12"><h2>' . $title . '</h2></div>';

        foreach($members as $m) {
            if($officersOnly && !$m['position']['officer']) {
                continue;
            } else if($votingOnly && !$m['position']['voting']) {
                continue;
            }

            $image = $m['person']['image'];
            $personName = $m['person']['name'];

            $html .= "
                <div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">
                    <a class=\"person-item small\" href=\"/updates\">
                        <div class=\"person-image\" " . ($image != '' ? "style=\"height: 186.65px; background-image: url('$image')\"" : "style=\"height: 186.65px\"") . "></div>
                        <div class=\"person-content\" style=\"min-height: 100px\">
                            <h4>$personName</h4>
                            <p class=\"position\" style=\"font-size: 0.75rem;\">$m[name]</p>
                        </div>
                    </a>
                </div>
            ";
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
        <?=loadMembers('Officers', $members, true, false) ?>
        <?=loadMembers('Voting Members', $members, false, true) ?>
        <section class="row">
            <div class="col-xs-12"><h2>Other Sessions</h2></div>
            <?php
            $otherSessions = json_decode(file_get_contents("https://data.sg.rpi.edu/api/sessions?bodyUniqueId=$bodyUniqueId&sort=-name"), true);

            foreach($otherSessions as $s) {
                if($s['uniqueId'] == $uniqueId) continue;

                echo "<div class='col-xs-3'><p><a class='btn' href='/people/session.php?bodyUniqueId=$bodyUniqueId&uniqueId=$s[uniqueId]'>$s[name]</a></p></div>";
            }
            ?>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
