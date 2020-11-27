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
                    <h2>SIGN UP</h2>
                <p>Already a member with us? Head to the <a href="login.php">Login </a>page now!</p>
                </header>

                <section class="wrapper style4 special container medium">

                    <!-- Content -->
                    <div class="content">
                        <form action="signup_next.php" method="post">
                            <div class="row gtr-50">
                                <strong>Username:</strong>
                                <div class="col-12">
                                    <input type="text" required name="username" id="username" placeholder="This must be unique" />
                                    <br>
                                </div>
                                
                                <strong>Email:</strong>
                                <div class="col-12">
                                    <input type="email" required name="email" id="email" placeholder="Your email" />
                                    <br>
                                </div>
                                
                                <strong>First Name:</strong>
                                <div class="col-12">
                                    <input type="text" name="first_name" id="first_name" placeholder="Your first name (If you have one)" />
                                    <br>
                                </div>
                                
                                <strong>Last Name:</strong>
                                <div class="col-12">
                                    <input type="text" required name="last_name" id="last_name" placeholder="Your last name (Required)" />
                                    <br>
                                </div>
                                
                                <strong>Password:</strong>
                                <div class="col-12">
                                    <input type="password" name="password" required minlength="8" id="password" placeholder="Your password" />
                                    <br>
                                </div>

                                <strong>Confirm Password:</strong>
                                <div class="col-12">
                                    <input type="password" name="confirm_password" required minlength="8" id="confirm_password" placeholder="Confirm your password" />
                                </div>                                
                                <p>Your password must have at least 8 characters with at least one alphabet and one number.</p>
                                
                                <p>By logging in, you agree to the <a href="#">terms and conditions</a> of BEST Co.</p>
                            </div>
                            <button class="buttons" type="submit">Sign Up Now</button>
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