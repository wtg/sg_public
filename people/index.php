
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <?php
            $urlComponents = explode('/', $_SERVER['REQUEST_URI']);

            if(count($urlComponents) == 3 && strlen($urlComponents[2]) > 0) {
                $name = ucwords(str_replace("-"," ",$urlComponents[2]));
                require_once '../partials/member_detail.php';
            } else { ?>
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
                    <div class="col-lg-fifth col-md-4 col-xs-6">
                        <a class="person-item" href="/people/paul-ilori">
                            <div class="person-image" style="background-image: url('http://stugov.union.rpi.edu/senate/wp-content/uploads/sites/2/2015/03/Paul-Ilori-768x768.jpg')">
                            </div>
                            <div class="person-content">
                                <h4>Paul Ilori</h4>
                                <p class="position">151<sup>st</sup> Grand Marshal</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-fifth col-md-4 col-xs-6">
                        <a class="person-item" href="/updates">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Chip Kirchner</h4>
                                <p class="position">127<sup>st</sup> President of the Union</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-fifth col-md-4 col-xs-6">
                        <a class="person-item" href="/updates">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Nathan James</h4>
                                <p class="position">Judicial Board Chairman</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-fifth col-lg-offset-0 col-md-4 col-md-offset-2 col-xs-6">
                        <a class="person-item" href="/updates">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Eryka Greaves</h4>
                                <p class="position">Undergraduate President</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-fifth col-md-4 col-md-offset-0 col-xs-6 col-xs-offset-3">
                        <a class="person-item" href="/updates">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Jennifer Church</h4>
                                <p class="position">Graduate Council President</p>
                            </div>
                        </a>
                    </div>
                </section>
                <hr />
                <section class="row">
                    <div class="col-xs-12">
                        <h2>Members of Bodies</h2>
                    </div>
                </section>
                <section class="row">
                    <div class="col-lg-4 col-md-6">
                        <a class="person-item" href="/people/senate">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Student Senate</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a class="person-item" href="/people/eboard">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Executive Board</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a class="person-item" href="/people/jboard">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Judicial Board</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-0">
                        <a class="person-item" href="/people/uc">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Undergraduate Council</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-lg-offset-0 col-md-6 col-md-offset-3">
                        <a class="person-item" href="/people/gc">
                            <div class="person-image">
                            </div>
                            <div class="person-content">
                                <h4>Graduate Council</h4>
                            </div>
                        </a>
                    </div>
                </section>
        <?php } ?>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
