<?php
include_once '../partials/api.php';

$unionOfficers = json_decode(file_get_contents($API_BASE . "api/positions"), true);
$sessions = json_decode(file_get_contents($API_BASE . "api/sessions?active=true"), true);

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
                        $image = $m['person']['image'];
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
                echo "<div class='col-lg-fifth col-md-6'>
                    <a class='person-item' href='/people/session.php?bodyUniqueId=$s[bodyUniqueId]&uniqueId=$s[uniqueId]'>
                        <div class='person-image oblong'></div>
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
