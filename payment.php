<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='ict1004best@gmail.com'; // Business email ID
session_start();

if (!(isset($_SESSION['loggedin'])))
{
	//header("Location: index.php");
}

else
{
    
}
?>

<style>
body
{
    font: bold 14px arial;
}
.product
{
    float: left;
    margin-right: 10px;
    border: 1px solid #cecece;
    padding: 10px;
    margin-right: 20px;
}
</style>
<!--
<div style="margin:50px">
    <h3>Note: Create a test buyer account at Paypal Sandbox then pay</h3>
    <h3><a href=" https://developer.paypal.com/" target="_blank"> https://developer.paypal.com/</a></h3>
</div>
-->
<h3>Welcome <?php print_r ($_SESSION['username'])?> </h3>
<h4>We only accept Paypal payments as of date </h4>
<h4>Please click "Buy Now" to proceed with payment</h4>

<div class="product">            
    <div class="image">
        <img src="\HTML/logo1.gif" />
    </div>
    <div class="name">
        Payment
    </div>
    <div class="price">
        Total Price: $ <?php echo $_POST['result']; ?>
    </div>
	<?php
	$totalquantity = $_POST['totalquantity'];
	$item_name = $_SESSION['item_name'];
	?>
    <div class="btn">
    <form action="<?php echo $paypal_url ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?php echo $item_name ?>">
    <input type="hidden" name="credits" value="510">
	<input type="hidden" name="userid" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="quantity" value="<?php echo $_POST['totalquantity']?>">
    <input type="hidden" name="amount" value=9>
    <input type="hidden" name="cpp_header_image" value="\HTML/logo1">
    <input type="hidden" name="currency_code" value="SGD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="https://localhost/cancel.php">
    <input type="hidden" name="return" value="https://localhost/success.php">
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> 
    </div>
</div>
