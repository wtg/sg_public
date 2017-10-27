<?php
include_once '../partials/api.php';

$id = $_GET['id'];
$position = json_decode(file_get_contents($API_BASE . "api/positions?id=$id"), true)[0];
?>
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php'; ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row" style="margin-top: 2rem">
            <div class="col-xs-12">
                <?php
                    echo "
                        <h1 style='margin-top: 0; line-height: 1'>$position[name]</h1>
                        <h3 style='font-size: 1.6rem'>" . $position['body']['name'] . "</h3>
                    ";

                    $currentHolders = '';
                    $pastHolders = '';
                    $currentCount = 0;
                    $pastCount = 0;

                    foreach($position['memberships'] as $m) {
                        $val = "<div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">
                            <a class=\"person-item small\" href=\"/people/member_detail.php?rcsId=$m[personRcsId]\">
                                <div class=\"person-image\" " . ($m['person']['image'] != '' ? "style=\"height: 186.65px; background-image: url('" . $m['person']['image'] . "')\"" : "style=\"height: 186.65px\"") . "></div>
                                <div class=\"person-content\" style=\"min-height: 100px\">
                                    <h4>" . $m['person']['name'] . "</h4>
                                    <p class=\"position\" style=\"font-size: 0.75rem;\">$m[name]</p>
                                </div>
                            </a>
                        </div>";

                        if(!isset($m['endDate'])) {
                            $currentHolders .= $val;
                            $currentCount++;
                        } else {
                            $pastHolders .= $val;
                            $pastCount++;
                        }
                    }

                    if($currentCount > 0) {
                        echo "<h2>Current Holder" . ($currentCount > 1 ? 's' : '') . "</h2><div class='row'>$currentHolders</div>";
                    }

                    if($pastCount > 0) {
                        echo "<h2>Past Holder" . ($pastCount > 1 ? 's' : '') . "</h2><div class='row'>$pastHolders</div>";
                    }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
