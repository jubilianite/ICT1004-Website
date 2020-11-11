<center><a href="/index.php"><IMG SRC="\HTML/logo1.gif" ALT="Logo"></a></center>
<center><?php
echo "<h1>Thank you for supporting us!</h1>";
echo "\n";
echo "<h2>We will contact you immediately when your order is ready for collection.</h2>";
echo "\n";
echo "<h2>Your transaction ID is</h2>";
//header( "refresh:60;url=\index.php" );
?></center>
<?php
session_start();
//ini_set('display_errors',1); 
//error_reporting(E_ALL);



$item_transaction=$_REQUEST['tx']; // Paypal transaction ID
$item_price=$_REQUEST['amt']; // Paypal received amount
$item_currency=$_REQUEST['cc']; // Paypal received currency type
echo "<center><h2>$item_transaction</h2></center>";
$connection = mysqli_connect("localhost", "root", "", "juvenileschooluniforms")or die("cannot connect");

$sql=$connection->prepare("SELECT first_name, last_name FROM user_account WHERE user_id=?");
$sql->bind_param('s',$_SESSION['user_id']); 
$sql->execute();
$sql->bind_result($first_name, $last_name);
$sql->fetch();
$connection->close();

$date = date('Y-m-d H:i:s');
$school_ref_id = $_SESSION['school_ref_id'];
$payment_method = "Paypal";

$username = $_SESSION['username'];
$shirt_xxs = $_SESSION['shirt_xxs'];
$shirt_xs = $_SESSION['shirt_xs'];
$shirt_s = $_SESSION['shirt_s'] ;
$shirt_m = $_SESSION['shirt_m'] ;
$shirt_l = $_SESSION['shirt_l'];
$shirt_xl = $_SESSION['shirt_xl']; 
$shirt_xxl = $_SESSION['shirt_xxl']; 
$short_xxs = $_SESSION['short_xxs'];
$short_xs = $_SESSION['short_xs'] ;
$short_s = $_SESSION['short_s'];
$short_m = $_SESSION['short_m'];
$short_l = $_SESSION['short_l'];
$short_xl = $_SESSION['short_xl'];
$short_xxl = $_SESSION['short_xxl'];
$payment_method = 'Paypal';

$mysqli = new mysqli('localhost', 'root', '', 'juvenileschooluniforms');
$stmt=$mysqli->prepare("INSERT INTO `transactions` (`transaction_id`, `date_and_time`, `username`, `first_name`, `last_name`, `school_ref_id`, `shirt_xxs`, `shirt_xs`, `shirt_s`, `shirt_m`, `shirt_l`, `shirt_xl`, `shirt_xxl`, `short_xxs`, `short_xs`, `short_s`, `short_m`, `short_l`, `short_xl`, `short_xxl`, `total_amountpaid`, `payment_method`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param('ssssssiiiiiiiiiiiiiiis',$item_transaction, $date, $username, $first_name, $last_name, $school_ref_id, $shirt_xxs, $shirt_xs, $shirt_s, $shirt_m, $shirt_l, $shirt_xl, $shirt_xxl, $short_xxs, $short_xs, $short_s, $short_m, $short_l, $short_xl, $short_xxl , $item_price, $payment_method); 
if ($stmt->execute()){  //execute query
  //echo "Query executed.";
}else{
  //echo "Query not executed yet ";
  //echo ($mysqli->error);
  die();
}
$stmt->close();
$mysqli->close();

$title = "PayPal Payment";
$heading = "Welcome to Paypal Payment";

?>