<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <?php include "if_loggedin.php"; ?>
    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php 
            include "header.inc.php";
            require_once "paypal_config.php";
            $_SESSION['product_name'] = $_POST['product_name']; //We'll need it later after payment is successful
            $amount = $_POST['product_price'];
            ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span><img src="https://www.flaticon.com/svg/static/icons/svg/1/1687.svg" alt="" style="width:10%;"/></span>
                    <h2>Order Confirmation</h2>

                </header>

                <section class="wrapper style4 container">

                    <!-- Content -->
                    <div class="content">
                        <section>
                            <?php echo "<h4>" . $_POST['product_name'] . "</h4>"?>
                            <?php echo "<p>" . $_POST['description'] . "</p>"?>
                            <form action="<?php echo $paypal_url ?>" method="post" name="frmPayPal1">
                                        <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
                                        <input type="hidden" name="cmd" value="_xclick">
                                        <input type="hidden" name="item_name" value="<?php echo $_POST['product_name'] ?>">
                                        <input type="hidden" name="credits" value="510">
                                        <input type="hidden" name="userid" value="1">
                                        <input type="hidden" name="no_shipping" value="1">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="amount" value="<?php echo $amount ?>">
                                        <!--<input type="hidden" name="cpp_header_image" value="/logo1">-->
                                        <input type="hidden" name="currency_code" value="SGD">
                                        <input type="hidden" name="cancel_return" value="<?php echo $payment_cancel ?>">
                                        <input type="hidden" name="return" value="<?php echo $payment_success ?>">
                            <button class="buttons" type="submit">Make Payment</button>
                            </form>
                        </section>
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