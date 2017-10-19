<?php
$gm = json_decode(file_get_contents("https://data.sg.rpi.edu/api/memberships?positionId=1&endDate=null"), true)[0];
$pu = json_decode(file_get_contents("https://data.sg.rpi.edu/api/memberships?positionId=19&endDate=null"), true)[0];
?>
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php' ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <style type="text/css">
        /* I know this is bad and should not be here. It's short term, don't judge! */

        a {
            color: #c40000;
        }
    </style>
    <main class="container">
        <section class="row">
            <div class="col-xs-12">
                <h1>Get Involved!</h1>
                <p class="lead">
                    Student government at RPI is <strong>by the students, for the students</strong>, not just those who are currently in office. If you're passionate about improving RPI for the future, there are many opportunities for you to get involved.
                </p>
            </div>
        </section>
        <hr />
        <section class="row">
            <div class="col-md-3">
                <a class="update-item" href="/about">
                    <div class="update-image" style="background-image: url('//sg.rpi.edu/studentgovernment/wp-content/uploads/2015/03/20140506_Banner_0001.jpg')">
                    </div>
                    <div class="update-content">
                        <h4>Join Committees</h4>
                        <p>
                            Committees are open to all students, pursuing projects and proposals that improve the daily lives of RPI students.
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="update-item" href="http://petitions.union.rpi.edu/">
                    <div class="update-image" style="background-image: url('//poly.rpi.edu/wp-content/uploads/2014-03-26/senate_webleveled_-_joseph_shen.jpg')">
                    </div>
                    <div class="update-content">
                        <h4>Petition the Senate</h4>
                        <p>
                            Petitions are a great way to build student consensus on an issue that's important to you and your peers.
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="update-item" href="/updates">
                    <div class="update-image" style="background-image: url('//poly.rpi.edu/wp-content/uploads/2017-04-19/senate_-_webleveled_-_jonathan_caicedo.jpg')">
                    </div>
                    <div class="update-content">
                        <h4>Present to the Senate</h4>
                        <p>
                            All Senate meetings are open to the public and have an agenda item for hearing from passionate students!
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a class="update-item" href="http://elections.union.rpi.edu">
                    <div class="update-image" style="background-image: url('//poly.rpi.edu/wp-content/uploads/2012-04-18/rpi_4549.jpg')">
                    </div>
                    <div class="update-content">
                        <h4>Run for office</h4>
                        <p>
                            With freshmen elections each fall and GM Week elections each spring, there's always opportunities to get involved.
                        </p>
                    </div>
                </a>
            </div>
        </section>
        <hr />
        <section class="row">
            <div class="col-xs-12">
                <h2>Contact student government</h2>
                <p class="lead">
                    As always, you can reach out to the
                    <?=$gm['position']['name']?>, <?=$gm['person']['name']?>, at <a href="mailto:<?=$gm['person']['email']?>"><?=$gm['person']['email']?></a>,
                    and the
                    <?=$pu['position']['name']?>, <?=$pu['person']['name']?>, at <a href="mailto:<?=$pu['person']['email']?>"><?=$pu['person']['email']?></a>
                    if you have any questions, comments, ideas, or concerns.
                </p>
            </div>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
