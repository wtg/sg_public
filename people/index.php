<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php';

$unionOfficers = [];
$unionOfficers[] = Positions::read([
    "presidingOfficer" => "true",
    "name" => "Grand Marshal"
])[0];
$unionOfficers[] = Positions::read([
    "presidingOfficer" => "true",
    "name" => "President of the Union"
])[0];
$unionOfficers[] = Positions::read([
    "presidingOfficer" => "true",
    "name" => "Judicial Board Chairperson"
])[0];
$unionOfficers[] = Positions::read([
    "presidingOfficer" => "true",
    "name" => "Undergraduate President"
])[0];
$unionOfficers[] = Positions::read([
    "presidingOfficer" => "true",
    "name" => "Graduate Council President"
])[0];

$sessions = Sessions::read([
    "active" => "true"
]);

?>

<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1>People</h1>
            </div>
        </section>
        <section class="row">
            <div class="col-xs-12">
                <h2>Officers of the Union</h2>
            </div>
        </section>
        <section class="row">
            <?php
            foreach($unionOfficers as $position) {
                foreach($position['memberships'] as $m) {
                    if($m['current']) {
                        if(isset($m['person']['image'])) {
                           $image = $m['person']['image'];
                        } else {
                            $image = "//photos.sg.rpi.edu/headshot_$m[personRcsId].jpg";
                        }
                        $name = $m['person']['name'];
                        echo "<div class='col-lg-fifth col-md-4 col-xs-6'>
                            <a class='person-item' href='/people/member_detail.php?rcsId=$m[personRcsId]'>
                                <div class='person-image' style='background-image: url(\"$image\")'></div>
                                <div class='person-content'>
                                    <h4>$name</h4>
                                    <p class='position'>$m[name]</p>
                                </div>
                            </a>
                        </div>";
                    }
                }
            }
            ?>
        </section>
        <hr />
        <section class="row">
            <div class="col-xs-12">
                <h2>Members of Bodies</h2>
            </div>
        </section>
        <section class="row">
            <?php
            foreach($sessions as $s) {
                $name = $s['body']['name'];
                $image = "//photos.sg.rpi.edu/body_$s[bodyUniqueId].jpg";
                echo "<div class='col-lg-fifth col-md-6'>
                    <a class='person-item' href='/people/session.php?bodyUniqueId=$s[bodyUniqueId]&uniqueId=$s[uniqueId]'>
                        <div class='person-image oblong' style='background-image: url(\"$image\")'></div>
                        <div class='person-content'>
                            <h4>$name</h4>
                        </div>
                    </a>
                </div>";
            }
            ?>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
