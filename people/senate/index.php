<?php
    function members($filename) {
        $members = json_decode(file_get_contents($filename), true);
        $html = '<section class="row">';

        foreach($members as $m) {
            $html .= "
                <div class=\"col-lg-2\">
                    <a class=\"person-item\" href=\"/updates\">
                        <div class=\"person-image\" " . ($m['image'] != '' ? "style=\"background-image: url('$m[image]')\"" : "") . "></div>
                        <div class=\"person-content\">
                            <h4>$m[name]</h4>
                            <p class=\"position\">$m[position]</p>
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
                <h1>Student Senate</h1>
            </div>
        </section>
        <?=members('senate.json'); ?>
    </main>
    <?php require_once '../../partials/footer.php' ?>
</body>
</html>
