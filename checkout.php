<?php

	//start session
	session_start();
	//mysql connection
	include_once("config.php");

	//$_SESSION['connection'] = $connection;

	// Check that the connection was successful, otherwise exit
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

	//detect the user action
	//case1: confirm purchase
	//case2: cancel purchase

	//check if the request method is post and evaluate the if statements
	if($_SERVER["REQUEST_METHOD"] == 'POST') {
		if (isset($_POST["checkout"]) && $_POST["checkout"] ==  "CHECKOUT") {
			$CID = $_SESSION['CID'];
			echo "<script type=\"text/2javascript\">document.location.href=\"login.php\";</script>";
		}
		elseif (isset($_POST["cancel"]) && $_POST["cancel"] ==  "CANCEL") {

			//move to shopping cart page
			echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";
			//}
		}
	}
?>

<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title> CPSC 304 - Shopping Cart </title>

<!--
	stylesheet
-->
	<link href="styles.css" rel="stylesheet" type="text/css">
	
</head>
<body>
	<form id="checkout" name="checkout" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Credit Card Number</td><td><input type="text" size=30 name="new_CC_number"</td></tr>
        <tr><td>Expiry Date</td><td><input type="text" size=30 name="new_expiry_date"</td></tr>
        <tr><td></td><td><input type="submit" name="checkout" border=0 value="CONFIRM"></td></tr>
        <tr><td></td><td><input type="submit" name="cancel" border=0 value="CANCEL"></td></tr>
    </table>
</form>
</body>
</html>