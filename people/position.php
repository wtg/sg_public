<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php';

$id = $_GET['id'];
$position = Positions::getEntry($id);
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
                    $currentRcsIds = [];
                    $pastRcsIds = [];

                    foreach($position['memberships'] as $m) {
                        if(isset($m['person']['image'])) {
                            $image = $m['person']['image'];
                        } else {
                            $image = "//photos.sg.rpi.edu/headshot_$m[personRcsId].jpg";
                        }

                        $val = "<div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6 col-person\">
                            <a class=\"person-item small\" href=\"/people/member_detail.php?rcsId=$m[personRcsId]\">
                                <div class=\"person-image\" style=\"background-image: url('$image')\"></div>
                                <div class=\"person-content\">
                                    <h4>" . $m['person']['name'] . "</h4>
                                    <p class=\"position\">$m[name]</p>
                                </div>
                            </a>
                        </div>";

                        if(!isset($m['endDate'])) {
                            $currentHolders .= $val;
                            $currentRcsIds[] = $m['personRcsId'];
                            $currentCount++;
                        } else if(!array_search($m['personRcsId'], $currentRcsIds) && !array_search($m['personRcsId'], $pastRcsIds)) {
                            $pastHolders .= $val;
                            $pastRcsIds[] = $m['personRcsId'];
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
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
