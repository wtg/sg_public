<?php
include_once '../partials/api.php';

$rcsId = $_GET['rcsId'];
$m = json_decode(file_get_contents($API_BASE . "api/people/$rcsId"), true);

$pos = "";
$pastPos = "";
$positionHeadline = "";
$assignments = "";
$involvements = "";

if(isset($m['memberships'])) {
    usort($m['memberships'], function ($item1, $item2) {
        if ($item1['endDate'] == $item2['endDate']) {
            if ($item1['startDate'] == $item2['startDate']) return 0;
            return $item1['startDate']< $item2['startDate'] ? 1 : -1;
        }
        return $item1['endDate'] < $item2['endDate'] ? 1 : -1;
    });

    foreach ($m['memberships'] as $p) {
        if($p['current']) {
            $pos .= "<tr><td><a href='/people/position.php?id=$p[positionId]'>$p[name]</a></td><td>$p[term]</td></tr>";
            if(strlen($positionHeadline) > 0) {
                $positionHeadline .= ", ";
            }
            $positionHeadline = "$p[name]";
        } else {
            $pastPos .= "<tr><td><a href='/people/position.php?id=$p[positionId]'>$p[name]</a></td><td>$p[term]</td></tr>";
        }
    }

    if(strlen($positionHeadline) == 0 && count($m['memberships']) > 0) {
        $positionHeadline .= $m['memberships'][0]['name'];
    }
}

if(isset($m['committees'])) {
    $assignments = $m['committees'];
}

if(isset($m['campusInvolvements'])) {
    $involvements = $m['campusInvolvements'];
}

if(isset($m['image'])) {
    $image = $m['image'];
} else {
    $image = '/img/blank_profile.png';
}
?>
<!DOCTYPE html>
<html>
<?php require_once '../partials/head.php'; ?>
<body>
    <?php require_once '../partials/nav.php'; ?>
    <main class="container">
        <section class="row" style="margin-top: 2rem">
            <?php
                echo "
                    <div class='col-sm-4'>
                        <img class='img-responsive' src='$image' />
                        <table class='positions-table current'>
                            $pos
                        </table>";
                        if(isset($m['memberships'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td colspan='2'>Past Roles:</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    $pastPos
                                </tbody>
                            </table>";
                        }
                        if(isset($m['email'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td>Email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><a href=\"mailto:$m[email]\">$m[email]</a></td>
                                </tbody>
                            </table>";
                        }
                        if(isset($m['hometown'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td>Hometown</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>$m[hometown]</td>
                                </tbody>
                            </table>";
                        }
                        if(isset($m['classYear'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td>Class Year</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>$m[classYear]</td>
                                </tbody>
                            </table>";
                        }
                        if(isset($m['major'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td>Major</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>$m[major]</td>
                                </tbody>
                            </table>";
                        }
                        if(isset($m['committeeAssignments'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td>Committee Assignments</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>$assignments</td>
                                </tbody>
                            </table>";
                        }
                        if(isset($m['campusInvolvements'])) {
                            echo "<table class='positions-table'>
                                <thead>
                                    <tr>
                                        <td>Other Campus Involvements</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>$involvements</td>
                                </tbody>
                            </table>";
                        }
                    echo "</div>
                    <div class='col-sm-8 biography'>
                        <h1 style='margin-top: 0; line-height: 1'>$m[name]</h1>
                        <h2 style='font-size: 1.6rem'>$positionHeadline</h2>
                        <div class='lead'>$m[biographyHtml]</div>
                    </div>
                ";
            ?>
        </section>
    </main>
    <?php require_once '../partials/footer.php' ?>
    </body>
</html>
