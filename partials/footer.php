<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/vendor/autoload.php';

$bodies = Bodies::read();
?>
<footer class="footer">
    <div class="primary-footer container">
        <div class="row">
            <div class="col-lg-fifth col-md-3 col-sm-6 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                <h3>Student Government</h3>
                <ul>
                    <?php
                    foreach($bodies as $b) {
                        echo "<li><a href='/about/body.php?body=$b[uniqueId]'>$b[name]</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-fifth col-md-3 col-sm-6 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                <h3>Services</h3>
                <ul>
                    <li><a href="https://shuttles.rpi.edu">Shuttle Tracker</a></li>
                    <li><a href="https://elections.union.rpi.edu">RPI Elections</a></li>
                    <li><a href="https://petitions.union.rpi.edu">RPI Petitions</a></li>
                    <li><a href="https://github.com/wtg">Github</a>
                </ul>
            </div>
            <div class="col-lg-fifth col-md-3 col-sm-6 col-sm-offset-0 col-xs-6 col-xs-offset-3 col-sm-new-row">
                <h3>Helpful Links</h3>
                <ul>
                    <li><a href="http://union.rpi.edu/">Union Homepage</a></li>
                    <li><a href="/about/constitution">Union Constitution</a></li>
                    <li><a href="http://events.rpi.edu">Campus Events</a></li>
                    <li><a href="https://cms.union.rpi.edu">Club Management System</a></li>
                    <li><a href="http://www.union.rpi.edu/node/61">Starting a Club</a></li>
                </ul>
            </div>
            <div class="col-lg-fifth col-md-3 col-sm-6 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                <h3>Social Media</h3>
                <ul>
                    <li><a href="https://facebook.com/RPIStuGov"><i class="fa fa-facebook-square"></i>&ensp;Facebook</a></li>
                    <li><a href="https://twitter.com/RPIStudentGov"><i class="fa fa-twitter"></i>&ensp;Twitter</a></li>
                    <li><a href="https://instagram.com/RPIStuGov"><i class="fa fa-instagram"></i>&ensp;Instagram</a></li>
                    <li><a href="https://reddit.com/u/RPIStuGov"><i class="fa fa-reddit-alien"></i>&ensp;Reddit</a></li>
                </ul>
            </div>
            <div class="col-lg-fifth col-sm-12 contact">

                <a class="rpi-logo" href="https://rpi.edu"></a>

                <address>
                    <span>110 8th Street</span>
                    <span>Rensselaer Union</span>
                    <span>Troy, NY 12180</span>
                </address>

                <p>
                    <a href="tel:+15182766505">(518) 276-6505</a>
                    <a href="mailto:sg@rpi.edu">sg@rpi.edu</a>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="secondary-footer">
        <div class="container">
            <ul>
                <li><a href="https://data.sg.rpi.edu/">API</a></li>
                <li><a href="https://admin.sg.rpi.edu/">Log In</a></li>
            </ul>
            <p>Copyright &copy; 2017 &ndash; Rensselaer Union</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="/main.js"></script>
