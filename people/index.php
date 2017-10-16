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
            <div class="col-lg-fifth col-md-4 col-xs-6">
                <a class="person-item" href="/people/member_detail.php?rcsId=etzinj">
                    <div class="person-image" style="background-image: url('../img/justin_etzine.jpg')">
                    </div>
                    <div class="person-content">
                        <h4>Justin Etzine</h4>
                        <p class="position">152<sup>nd</sup> Grand Marshal</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-md-4 col-xs-6">
                <a class="person-item" href="/people/member_detail.php?rcsId=randm">
                    <div class="person-image" style="background-image: url('../img/matt_rand.jpg')">
                    </div>
                    <div class="person-content">
                        <h4>Matthew Rand</h4>
                        <p class="position">128<sup>th</sup> President of the Union</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-md-4 col-xs-6">
                <a class="person-item" href="/people">
                    <div class="person-image" style="background-image: url('../img/nathan_james.jpg')">
                    </div>
                    <div class="person-content">
                        <h4>Nathan James</h4>
                        <p class="position">Judicial Board Chairman</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-lg-offset-0 col-md-4 col-md-offset-2 col-xs-6">
                <a class="person-item" href="/people">
                    <div class="person-image" style="background-image: url('../img/kayla_cinnamon.jpg')">
                    </div>
                    <div class="person-content">
                        <h4>Kayla Cinnamon</h4>
                        <p class="position">Undergraduate President</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-md-4 col-md-offset-0 col-xs-6 col-xs-offset-3">
                <a class="person-item" href="/people">
                    <div class="person-image" style="background-image: url('../img/spencer_scott.jpg')">
                    </div>
                    <div class="person-content">
                        <h4>Spencer Scott</h4>
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
            <div class="col-lg-fifth col-md-6">
                <a class="person-item" href="/people/senate">
                    <div class="person-image oblong">
                    </div>
                    <div class="person-content">
                        <h4>Student Senate</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-md-6">
                <a class="person-item" href="/people/eboard">
                    <div class="person-image oblong">
                    </div>
                    <div class="person-content">
                        <h4>Executive Board</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-md-6">
                <a class="person-item" href="/people/jboard">
                    <div class="person-image oblong">
                    </div>
                    <div class="person-content">
                        <h4>Judicial Board</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-md-6">
                <a class="person-item" href="/people/uc">
                    <div class="person-image oblong">
                    </div>
                    <div class="person-content">
                        <h4>Undergraduate Council</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-fifth col-lg-offset-0 col-md-6 col-md-offset-3">
                <a class="person-item" href="/people/gc">
                    <div class="person-image oblong">
                    </div>
                    <div class="person-content">
                        <h4>Graduate Council</h4>
                    </div>
                </a>
            </div>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
