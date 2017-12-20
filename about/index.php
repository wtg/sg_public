<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php';

$bodies = Bodies::read();

if(isset($_GET['body'])) {
    $query = ["bodyUniqueId" => $_GET['body']];
} else {
    $query = [];
}

$subbodies = Subbodies::read($query);
?>
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1>By the students, for the students.</h1>
                <p class="lead">
                    Student government at Rensselaer Polytechnic Institute aims to lead the student body in fulfilling
                    the mission of the Rensselaer Union. The various bodies of student government are responsible for
                    serving as a medium through which student opinion may be expressed, coordinating all student
                    organizations, leading student action, and collaborating with the campus for welfare and betterment
                    of our alma mater.
                </p>
                <p class="lead">
                    The student government consists of a legislative branch, the Student Senate, a financial branch,
                    the Executive Board, a judicial branch, the Judicial Board, and two representational branches, the
                    Undergraduate Council and the Graduate Council. The Union, including student government, are governed
                    by the <em>Rensselaer Union Constitution</em>.
                </p>
            </div>
        </section>
        <hr />
        <section class="row">
            <div class="col-xs-12">
                <h2>Structure</h2>
            </div>
        </section>
        <section class="row org-chart">
            <a href="/about/constitution" class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-xs-6 col-xs-offset-0 constitution-panel">
                <p><i class="fa fa-file-text"></i></p>
                <h3>Union Constitution</h3>
            </a>
        </section>
        <section class="row org-chart">
            <div class="col-md-fifth col-md-offset-0 col-xs-6 col-xs-offset-6">
                <a class="govt-body-panel first">
                    <p><i class="fa fa-institution"></i></p>
                    <h3>Student Senate</h3>
                </a>
                <a class="leader-panel" href="/about/gm">
                    <p class="lead">Lead by the </p>
                    <h3>Grand Marshal</h3>
                </a>
            </div>
            <div class="col-md-fifth col-md-offset-0 col-xs-6 col-xs-offset-6">
                <a class="govt-body-panel">
                    <p><i class="fa fa-money"></i></p>
                    <h3>Executive Board</h3>
                </a>
                <a class="leader-panel">
                    <p class="lead">Lead by the </p>
                    <h3>President of the Union</h3>
                </a>
            </div>
            <div class="col-md-fifth col-md-offset-0 col-xs-6 col-xs-offset-6">
                <a class="govt-body-panel">
                    <p><i class="fa fa-gavel"></i></p>
                    <h3>Judicial Board</h3>
                </a>
                <a class="leader-panel">
                    <p class="lead">Lead by the </p>
                    <h3>Judicial Board Chairman</h3>
                </a>
            </div>
            <div class="col-md-fifth col-md-offset-0 col-xs-6 col-xs-offset-6">
                <a class="govt-body-panel">
                    <p><i class="fa fa-users"></i></p>
                    <h3>Undergraduate Council</h3>
                </a>
                <a class="leader-panel">
                    <p class="lead">Lead by the </p>
                    <h3>Undergraduate President</h3>
                </a>
            </div>
            <div class="col-md-fifth col-md-offset-0 col-xs-6 col-xs-offset-6">
                <a class="govt-body-panel last">
                    <p><i class="fa fa-users"></i></p>
                    <h3>Graduate Council</h3>
                </a>
                <a class="leader-panel">
                    <p class="lead">Lead by the </p>
                    <h3>Graduate President</h3>
                </a>
            </div>
        </section>
        <hr />
        <a id="subbodies"></a>
        <section class="row">
            <div class="col-xs-12">
                <h2>Committees, Councils, and Sub-Bodies</h2>
            </div>
        </section>
        <section class="row">
            <div class="col-md-2 sidebar">
                <h3>Filter by Body</h3>
                <a href="/about#subbodies" <?=(isset($_GET['body']) ? '' : 'class="active"') ?>>All Bodies</a>
                <?php
                    foreach($bodies as $entry) {
                        echo "<a href=\"/about?body=$entry[uniqueId]#subbodies\""
                            . ((isset($_GET['body']) && $_GET['body'] == $entry['uniqueId']) ? 'class="active"' : '')
                            . ">$entry[name]</a>";
                    }
                ?>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <?php
                        if(count($subbodies) === 0) {
                            echo "<p class='text-muted'>No sub-bodies were found for this body!</p>";
                        }

                        foreach($subbodies as $s) {
                            $sessionName = $s['session']['name'];
                            echo "
                                <div class='col-lg-4 col-md-6 col-sm-6'>
                                    <a href='/about/committees' class='committee-item'>
                                        <div class='committee-image'></div>
                                        <div class='committee-content'>
                                            <h4>$s[name]</h4>
                                            <p class='position'>$sessionName</p>
                                        </div>
                                    </a>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>

        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
