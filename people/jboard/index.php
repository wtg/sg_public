<?php
    function members($title, $filename, $officersOnly, $votingOnly) {
        $members = json_decode(file_get_contents($filename), true);
        $html = '<section class="row">';

        $html .= '<div class="col-xs-12"><h2>' . $title . '</h2></div>';

        foreach($members as $m) {
            if($officersOnly && (!isset($m['officer']) || !$m['officer'])) {
                continue;
            } else if($votingOnly && isset($m['nonVoting']) && $m['nonVoting']) {
                continue;
            }

            $html .= "
                <div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">
                    <a class=\"person-item small\" href=\"/updates\">
                        <div class=\"person-image\" " . ($m['image'] != '' ? "style=\"height: 186.65px; background-image: url('$m[image]')\"" : "style=\"height: 186.65px\"") . "></div>
                        <div class=\"person-content\" style=\"min-height: 100px\">
                            <h4>$m[name]</h4>
                            <p class=\"position\" style=\"font-size: 0.75rem;\">$m[position]</p>
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
<?php require_once '../../partials/head.php' ?>
<body>
    <?php require_once '../../partials/nav.php'; ?>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1 style="margin-bottom: 0;">Judicial Board</h1>
            </div>
        </section>
        <?=members('Members', 'jboard.json', false, false); ?>
    </main>
    <?php require_once '../../partials/footer.php' ?>
</body>
</html>
