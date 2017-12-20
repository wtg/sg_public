
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<?php require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1>Projects</h1>
            </div>
        </section>
        <section class="row">
            <?php
            $sessions = Sessions::read([
                'active' => 'true'
            ]);

            foreach ($sessions as $s) {
                $projects = Projects::read([
                    'bodyUniqueId' => $s['bodyUniqueId'],
                    'sessionUniqueId' => $s['uniqueId'],
                ]);

                foreach ($projects as $p) {
                    echo "<div class='col-lg-fifth col-md-6'>";
                    echo "<a class='person-item' href='/projects/project.php?id=$p[id]'>";
                    echo "<div class='person-image oblong'></div>";
                    echo "<div class='person-content'>";
                    echo "<h4>$p[name]</h4>";
                    echo "<p class='position'>$s[name]</p>";
                    echo "</div></a>";

                    echo "</div>";
                }
            }
            ?>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
