<section class="row" style="margin-top: 2rem">
    <?php
        $members = json_decode(file_get_contents('senate/senate.json'), true);
        foreach ($members as $m) {
            if($m['name'] == $name) {
                echo "
                    <div class='col-lg-4'>
                        <img class='img-responsive' src='$m[image]' />
                        <table class='positions-table current'>
                            <tr>
                                <td>151<sup>st</sup> Grand Marshal</td>
                                <td>April 2016&ndash;present</td>
                            </tr>
                        </table>
                        <table class='positions-table'>
                            <thead>
                                <tr>
                                    <td colspan='2'>Past Roles:</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Class of 2017 Senator</td>
                                    <td>September 2013&ndash;April 2016</td>
                                </tr>
                                <tr>
                                    <td>SLC Chairman</td>
                                    <td>May 2015&ndash;April 2016</td>
                                </tr>
                                <tr>
                                    <td>RnE Chairman</td>
                                    <td>February 2015&ndash;November 2015</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='col-lg-8'>
                        <h1 style='margin-top: 0; line-height: 1'>$m[name]</h1>
                        <h2>$m[position]</h2>
                        <p class='lead'>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque cursus ligula eu convallis elementum. Aenean commodo ligula a augue bibendum consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec hendrerit, lectus quis sodales imperdiet, augue ligula tempor turpis, eu luctus nibh lacus in odio. Morbi pharetra mollis lorem, sit amet tempus dolor dictum in. Curabitur feugiat feugiat efficitur. Etiam faucibus efficitur ipsum, laoreet ultricies tellus iaculis non. Sed ut massa eu ante ultrices consectetur ut elementum mauris. Phasellus pretium dui eget tortor suscipit, at varius massa malesuada.
                        </p>
                        <p class='lead'>
Ut in laoreet arcu. Aliquam ut scelerisque nibh. Quisque condimentum arcu sem, tempor lobortis lacus tristique eget. Morbi scelerisque dolor sed dolor pulvinar, eget fringilla lacus condimentum. Phasellus sapien velit, egestas at odio eget, vehicula vestibulum urna. Donec sed purus sodales eros posuere rutrum ornare sit amet nunc. Quisque turpis massa, porta vel ex ornare, consectetur pharetra tellus. Integer nibh arcu, semper in tempor eu, consequat molestie tortor. Vestibulum rutrum, eros quis accumsan ornare, ligula nisi luctus turpis, quis aliquet lorem nisl a justo. Praesent non diam sed elit commodo rhoncus ac ut libero. Nulla ultricies suscipit pharetra. Aliquam semper eleifend ex nec placerat. Nullam tellus augue, vehicula id odio a, interdum pulvinar tortor. Morbi suscipit eleifend lacus, in scelerisque arcu consequat id. Nulla convallis congue neque ut ullamcorper. Cras id volutpat orci.
                        </p>
                    </div>
                ";
            }
        }
    ?>
</section>
