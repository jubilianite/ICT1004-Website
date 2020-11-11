<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>
            <?php
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
            $paypal_id = 'ict1004best@gmail.com'; // Business email ID 
            $payment_cancel = 'http://54.157.165.148/payment_cancel.php';
            $payment_success = 'http://54.157.165.148/payment_success.php';
            ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-mobile-alt"></span>
                    <h2>Professional Video Editing, Animation and Post Production Service</h2>
                    <p>20 years of experience and counting...</p>
                </header>

                <section class="wrapper style4 container">

                    <!-- Content -->
                    <div class="content">
                        <section>
                            <a href="#" class="image featured"><img src="images/videoediting.jpg" alt="" /></a>
                            <header>
                                <h3>About this Service</h3>
                            </header>
                            <p>We'll professionally edit your video to any requirements and upload your video to full resolution at either; 1080p (HD), 2K, or 4K.</p>
                            <p>We edit in Premiere Pro, After Effects, Photoshop and DaVinci Resolve, so can cover any requirements you request in regards to the video you require editing or animating.</p>
                            <p>We edit logo intro's, outro's, animations and templates in Adobe After Effects. We can also create special effects and provide green screen removal for your corporate videos or short films, in addition to custom animations. </p>
                            <p>We also take custom offers for specialized videos such as whiteboard videos, green screen editing, custom animations, etc.</p>
                            <p>We can also colour grade and provide custom motion graphics to your video to give it a professional finish.</p>
                        </section>
                    </div>

                </section>

                <!-- Two -->
                <section class="wrapper style1 container special">
                    <div class="row">
                        <div class="col-4 col-12-narrower">

                            <section>
                                <header>
                                    <h3><strong>Basic Package</strong></h3>
                                </header>
                                <p>Up to 5 minutes running time</p>
                                <p>Basic Color Grading</p>
                                <p>Sound Design & Mixing</p>
                                <p>Subtitles</p>
                                <p>Up to 2 revisions</p>
                                <footer>
                                    <form action="<?php echo $paypal_url ?>" method="post" name="frmPayPal1">
                                        <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
                                        <input type="hidden" name="cmd" value="_xclick">
                                        <input type="hidden" name="item_name" value="BEST Video Editing Basic Package">
                                        <input type="hidden" name="credits" value="510">
                                        <input type="hidden" name="userid" value="1">
                                        <input type="hidden" name="no_shipping" value="1">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="amount" value=100>
                                        <!--<input type="hidden" name="cpp_header_image" value="/logo1">-->
                                        <input type="hidden" name="currency_code" value="SGD">
                                        <input type="hidden" name="cancel_return" value="<?php echo $payment_cancel ?>">
                                        <input type="hidden" name="return" value="<?php echo $payment_success ?>">
                                        <ul class="buttons">
                                            
                                            <li><button class="buttons" type="submit">$100</button></li>
                                        </ul>
                                    </form>
                                </footer>
                            </section>

                        </div>
                        <div class="col-4 col-12-narrower">

                            <section>
                                <header>
                                    <h3><strong>Standard Package</strong></h3>
                                </header>
                                <p>Up to 15 minutes running time</p>
                                <p>Standard Color Grading</p>
                                <p>Sound Design & Mixing</p>
                                <p>Subtitles</p>
                                <p>Up to 5 revisions</p>
                                <footer>
                                    <ul class="buttons">
                                        <li><a href="#" class="button small">$500</a></li>
                                    </ul>
                                </footer>
                            </section>

                        </div>
                        <div class="col-4 col-12-narrower">

                            <section>
                                <header>
                                    <h3><strong>Premium Package</strong></h3>
                                </header>
                                <p>Up to 60 minutes running time</p>
                                <p>Premium Color Grading</p>
                                <p>Sound Design & Mixing</p>
                                <p>Subtitles</p>
                                <p>Motion Graphics</p>
                                <p>Up to 10 revisions</p>
                                <footer>
                                    <ul class="buttons">
                                        <li><a href="#" class="button small">$2000</a></li>
                                    </ul>
                                </footer>
                            </section>

                        </div>
                    </div>
                </section>

            </article>

            <!-- Footer -->
            <?php include "footer.inc.php"; ?>

        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/jquery.scrollgress.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>

    </body>
</html>