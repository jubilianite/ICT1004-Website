<!DOCTYPE HTML>
<html>
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>

    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h2>Forgot Your Password?</h2>
                    <p>Please fill in your Email & Username:</p>                    
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <form action="password_reset.php" method="post">
                            <div class="row gtr-50">
                                <strong>Email:</strong>
                                <div class="col-12">
                                    <input type="text" name="email" id="email" required name="email" pattern="[a-zA-Z0-9._%+-]+@[^@\s]+\.[^@\s]+"  placeholder="Email" />                                    
                                </div>                                
                                <strong>Username:</strong>
                                <div class="col-12">                                    
                                    <input type="text" name="username" id="username" required name="username" placeholder="Username" />
                                </div>                                
                                <strong>New Password:</strong>
                                <div class="col-12">
                                    <input type="password" name="password" required minlength="8" id="password" placeholder="New password" />
                                    <br>
                                </div>
                                <strong>Confirm New Password:</strong>
                                <div class="col-12">
                                    <input type="password" name="cfmpassword" required minlength="8" id="cfmpassword" placeholder="Confirm your password" />
                                </div>                                
                                <div class="col-12">
                                    <ul class="buttons">
                                        <li><input type="submit" class="special" value="Submit" /></li>
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