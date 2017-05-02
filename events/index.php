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
        ol li ol {
            list-style-type: lower-alpha;
        }
        article p {
            font-size: 1.25rem;
        }
        article h2 {
            margin-top: 0rem;
        }

        .embed-responsive {
            position: relative;
            display: block;
            height: 0;
            padding: 0;
            overflow: hidden;
        }

        .embed-responsive-16by9 {
            padding-bottom: 56.25%;
        }

        .embed-responsive .embed-responsive-item, .embed-responsive embed, .embed-responsive iframe, .embed-responsive object, .embed-responsive video {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
    <main class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Events</h1>

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://calendar.google.com/calendar/embed?mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=rpistudentsenate%40gmail.com&amp;color=%23333333&amp;ctz=America%2FNew_York" style="border-width:0" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>
        </div>
    </main>
    <?php require_once '../partials/footer.php' ?>
</body>
</html>
