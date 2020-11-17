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
                    <span class="icon solid fa-user-alt"></span>
                    <h2>Login</h2>
                <p>Not a member with us yet? Head to the <a href="signup.php">Sign Up </a>page now!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <form action="login_next.php" method="post">
                            <div class="row gtr-50">
                                <div class="col-12">
                                    <input type="text" name="username" id="username" placeholder="Username" />
                                </div>
                                <div class="col-12">
                                    <input type="password" name="password" required minlength="8" id="password" placeholder="Password" />
                                </div>
                                <p>Forgot your password? Click <a href="/forgot_password.php">here</a> to reset it!</p>
                                <div class="col-12">
                                    <ul class="buttons">
                                        <li><input type="submit" class="special" value="Login" /></li>
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