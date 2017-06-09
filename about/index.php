<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1>What is student government?</h1>
                <p class="lead">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet felis suscipit, euismod ipsum non, fringilla mi. Vivamus faucibus volutpat lobortis. Ut in aliquet felis. Sed lobortis pellentesque tristique. Vivamus sodales neque nec lectus sodales, at dictum diam semper. Duis gravida, enim a ultricies placerat, lorem quam pharetra diam, sit amet faucibus sem nisl in nibh. In egestas velit id magna ultricies, eu pulvinar enim tempus. Nullam a risus convallis, lobortis turpis sed, consequat dui. Cras quis porta neque. Sed et lectus orci. In vitae leo at enim auctor pharetra. Sed et volutpat urna, ut iaculis enim.
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
                <a class="leader-panel">
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
        <section class="row">
            <div class="col-xs-12">
                <h2>Committees and Councils</h2>
            </div>
        </section>
        <section class="row">
            <div class="col-md-2 sidebar">
                <h3>Filter by Body</h3>
                <a class="active">All Bodies</a>
                <a>Student Senate</a>
                <a>Executive Board</a>
                <a>Judicial Board</a>
                <a>Undergraduate Council</a>
                <a>Graduate Council</a>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <?php
                        $committees = json_decode(file_get_contents('committees.json'), true);

                        foreach($committees as $c) {
                            echo "
                                <div class='col-lg-4 col-md-6 col-sm-6'>
                                    <a href='/about/committees' class='committee-item'>
                                        <div class='committee-image'></div>
                                        <div class='committee-content'>
                                            <h4>$c[name]</h4>
                                            <p class='position'>$c[body]</p>
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
