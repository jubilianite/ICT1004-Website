<?php

//For troubleshooting purposes
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$currentpage = $_SERVER['REQUEST_URI'];
if ($currentpage == "/" || $currentpage == "/index.php" || $currentpage == "/index" || $currentpage == "") {
    echo "<header id='header' class='alt'>"; // Special Header Effect for index page
} else {
    echo "<header id='header'>"; //Normal header for everything else.
}

session_start();

if (!(isset($_SESSION['logged_in']))) {
    $if_loggedin = "<li>
                    <a href='/login.php' class='button primary'>Login Here!</a>
                    </li>";
} else if ($_SESSION['role']='admin') {
    $if_loggedin = "<li>
                    <a href='/profile.php' class='button primary'>Hi " . $_SESSION['username'] . " !</a>
                        <ul>
                        <li><a href='/profile.php'>Profile</a></li>
                        <li><a href='/adminpanel.php'>Admin Panel</a></li>
                        <li><a href='/transaction_history.php'>Transaction History</a></li>
                        <li><a href='/edit_product.php'>Edit Product</a></li> 
                        <li><a href='/logout.php'>Log Out</a></li>
                        </ul>
                    </li>";
} else {
    $if_loggedin = "<li>
                    <a href='/profile.php' class='button primary'>Hi " . $_SESSION['username'] . " !</a>
                        <ul>
                        <li><a href='/profile.php'>Profile</a></li>
                        <li><a href='/transaction_history.php'>Transaction History</a></li>
                        <li><a href='/logout.php'>Log Out</a></li>
                        </ul>
                    </li>";
}
?>

<h1 id="logo"><a href="index.php">BEST <span>is yet to come</span></a></h1>
<nav id="nav">
    <ul>
        <li class="current"><a href="index.php">Home</a></li>
        <li class="menu"><a href="contact.php">Contact Us</a></li>
        <li class="submenu">
            <a>Services</a>
            <ul>
                <li><a href="videoediting.php">Video Editing</a></li>
                <!-- May be useful if we want to expand, let's just keep this code here first -->
                <!--
                <li class="submenu">
                    <a href="#">Submenu</a>
                    <ul>
                        <li><a href="#">Dolore Sed</a></li>
                        <li><a href="#">Consequat</a></li>
                        <li><a href="#">Lorem Magna</a></li>
                        <li><a href="#">Sed Magna</a></li>
                        <li><a href="#">Ipsum Nisl</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </li>
<?php echo $if_loggedin; ?>

        <!--<ul>
            <li><a href="left-sidebar.html">Left Sidebar</a></li>
        </ul>-->


    </ul>
</nav>
<!--</header>-->
<?php echo "</header>"; ?>