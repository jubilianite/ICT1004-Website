<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>BEST</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://www.google.com/recaptcha/api.js" async defer ></script>

    </head>

    <body class="index is-preload">

        <div id="page-wrapper">

            <!-- Header -->
            <?php include "header.inc.php"; ?>

            <!-- Main -->
            <article id="main" role="main">

                <header class="special container">
                    <span class="icon solid fa-user-alt"></span>
                    <h1>Forgot Your Password?</h1>
                    <p>Please fill in the necessary details below:</p>                    
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content" aria-level="1">
                        <form action="forgot_password_next.php" method="post">
                            <div class="row gtr-50">
                                <strong>Email:</strong>
                                <div class="col-12">
                                    <input type="text" name="email" aria-label="Email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[^@\s]+\.[^@\s]+"  placeholder="Email" />                                    
                                </div>                                
                                <strong>Username:</strong>
                                <div class="col-12">                                    
                                    <input type="text" name="username" aria-label="Username" id="username" required placeholder="Username" />
                                </div>                                
                                <strong>New Password:</strong>
                                <div class="col-12">
                                    <input type="password" name="password" aria-label="Password" required minlength="8" id="password" placeholder="New password" />
                                </div>
                                <strong>Confirm New Password:</strong>
                                <div class="col-12">
                                    <input type="password" name="confirm_password" aria-label="Confirm Password" required minlength="8" id="confirm_password" placeholder="Confirm your password" />
                                </div>            
                                <p>Your password must have at least 8 characters with at least one alphabet and one number.</p>
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