<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main" role="main">

                <header class="special container">
                    <span class="icon solid fa-envelope"></span>
                    <h1>Get In Touch</h1>
                    <p>Want to get in touch? We'd love to hear from you. Here's how you can reach us...</p>
                </header>

                <section class="wrapper style4 special container medium">
                    <!-- Content -->
                    <div class="content" aria-level="1">
                        <form action= "contact_next.php" method="post">
                            <div class="row gtr-50">
                                <div class="col-6 col-12-mobile">
                                    <input type="text" name="name" aria-label="Name" required name="name" placeholder="Name" />
                                </div>
                                <div class="col-6 col-12-mobile">
                                    <input type="text" name="email" aria-label="Email" required name="email" pattern="[a-z0-9._%+-]+@[^@\s]+\.[^@\s]+" placeholder="Email" />
                                </div>
                                <div class="col-12">
                                    <input type="text" name="subject" aria-label="Subject" required name="subject" placeholder="Subject" />
                                </div>                             
                                <div class="col-12">
                                    <textarea name="message" aria-label="Message" placeholder="Message" equired name="message" rows="7"></textarea>
                                </div>
                                <div class="col-12">
                                    <ul class="buttons">
                                        <li><input type="submit" class="special" value="Send Message" /></li>
                                    </ul>
                                </div>                                
                            </div>
                        </form>
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