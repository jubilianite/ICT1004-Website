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

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-film"></span>
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
                            <p>We'll professionally edit your video to any requirements and upload your video to full resolution at either; 1080p (FHD), 2K, or 4K.</p>
                            <p>We edit in Premiere Pro, After Effects, Photoshop and DaVinci Resolve, so can cover any requirements you request in regards to the video you require editing or animating.</p>
                            <p>We edit logo intro's, outro's, animations and templates in Adobe After Effects. We can also create special effects and provide green screen removal for your corporate videos or short films, in addition to custom animations. </p>
                            <p>We also take custom offers for specialized videos such as whiteboard videos, green screen editing, custom animations, etc.</p>
                            <p>We can also colour grade and provide custom motion graphics to your video to give it a professional finish.</p>
                            <p>For now, we only accept payment through Paypal.</p>
                        </section>
                    </div>

                </section>

                <section class="wrapper style1 container special">
                    <div class="row">

                        <?php
                        $config = parse_ini_file('./../private/dbconfig.ini');
                        $conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);
                        $product_name = "Video Editing".'%'; //Declare Product Name Here

                        if ($conn->connect_error) {
                            $errorMsg = "Connection failed: " . $conn->connect_error;
                        } else {
                            $sql = $conn->prepare("SELECT product_id, product_name, product_price, description FROM `products` WHERE product_name LIKE ?");
                            $sql->bind_param('s', $product_name);
                            // Execute the query
                            $sql->execute() or die();
                            //$result = $sql->execute(); //Bind Data to $result
                            $sql->bind_result($product_id, $product_name, $product_price, $description) or die();

                                while ($sql->fetch()) {
                                    echo '<div class="col-4 col-12-narrower"><section>'; //Declare Header of DIV
                                    echo '<header><h3><strong>' . $product_name . '</strong></h3></header>';
                                    echo '<p>' . $description . '</p>';
                                    echo '<footer><form action="videoediting_payment.php" method="post">';
                                    echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                                    echo '<input type="hidden" name="product_name" value="' . $product_name . '">';
                                    echo '<input type="hidden" name="product_price" value="' . $product_price . '">';
                                    echo '<input type="hidden" name="description" value="' . $description . '">';
                                    echo '<ul class="buttons"><li><button class="buttons" type="submit">$' . $product_price . '</button></li></ul>';
                                    echo '</form></footer>';
                                    echo '</section></div>';
                                
                            }
                        }
                        ?>

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