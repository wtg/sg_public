<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php';

$update = Updates::getEntry($_GET['id']);
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
    article h2 {
        margin-top: 0rem;
    }
</style>
<main class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1><?=$update['title']?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <article>
                <img src="data:image/jpeg;base64,<?=implode($update['image']['data'])?>">
                <p class="small text-muted">
                    <?=$update['createdAt']?>
                </p>
                <?=$update['textHtml']?>
            </article>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <h3 style="margin-bottom: 0;">Filter by body</h3>
            <ul style="margin-top: 0.5rem;">
                <li>
                    <a href=""><strong>All</strong></a>
                </li>
                <li>
                    <a href="">Senate</a>
                </li>
                <li>
                    <a href="">Executive Board</a>
                </li>
                <li>
                    <a href="">Judicial Board</a>
                </li>
                <li>
                    <a href="">Undergraduate Council</a>
                </li>
                <li>
                    <a href="">Graduate Council</a>
                </li>
            </ul>
            <hr />
            <h3 style="margin-bottom: 0;">Filter by committee or council</h3>
            <ul style="margin-top: 0.5rem;">
                <li>
                    <a href=""><strong>All</strong></a>
                </li>
                <li>
                    <a href="">Student Life Committee</a>
                </li>
                <li>
                    <a href="">Academic Affairs Committee</a>
                </li>
                <li>
                    <a href="">Facilities and Services Committee</a>
                </li>
                <li>
                    <a href="">Union Policies Committee</a>
                </li>
                <li>
                    <a href="">Class of 2018 Council</a>
                </li>
                <li>
                    <a href="">Class of 2019 Council</a>
                </li>
                <li>
                    <a href="">Class of 2020 Council</a>
                </li>
                <li>
                    <a href="">Class of 2021 Council</a>
                </li>
            </ul>
        </div>
    </div>
</main>
<?php require_once '../partials/footer.php' ?>
</body>
</html>
