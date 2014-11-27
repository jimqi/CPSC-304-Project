<?php

	//start session
session_start();
$cart = $_SESSION['cart'];
	//mysql connection
require_once("config.php");
require_once("functions.php");

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
	if (isset($_POST["checkout"]) && $_POST["checkout"] ==  "CONFIRM") {
		$CID = $_SESSION['CID'];
		$card = $_POST['new_CC_number'];
		$expiryDate = $_POST['new_expiry_date'];
		$receiptID = rand(1, 10000);;
		$date = date("Y-m-d");
		$order_per_day = 10;

		$sql = "SELECT receiptID FROM orderr";
		$resulttemp = $connection->query($sql);
		$result = $resulttemp->num_rows;

		if($result<=$order_per_day) {
			$expectedDate = $date;
		}
		else {
			$temp = floor($result/$order_per_day);
			$expectedDate = date("Y-m-d", strtotime($Date. ' + '.$temp.' days'));
		}

			//Prepare the sql query
		$stmt = $connection->prepare("INSERT INTO orderr (receiptID, date, cid, card, expiryDate, expectedDate, deliveredDate) VALUES (?, ?, ?, ?, ?, ?, null);");

            //bind values and execute if they're set
		if(isset($receiptID) && isset($date) && isset($CID) && isset($card) && isset($expiryDate) && isset($expectedDate)) {
			$stmt->bind_param("isiiss", $receiptID, $date, $CID, $card, $expiryDate, $expectedDate);

			//execute the statement
			$stmt->execute();

			if($stmt->error) {
				printf("<b>Error: %s.</b>\n", $stmt->error);
			} else {
				echo "<b>Order Added</b>";
			}
			if ($cart) {
				$items = explode(',',$cart);
				$contents = array();
		// converts the string of upcs into upc:qty pairs
				foreach ($items as $item) {
					$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
				}
				foreach ($contents as $id=>$qty) {
					$stmt = $connection->prepare("INSERT INTO purchaseitem (receiptID, upc, quantity) VALUES (?, ?, ?);");
					$stmt->bind_param("iii", $receiptID, $id, $qty);
					$stmt->execute();
					if($stmt->error) {
						printf("<b>Error: %s.</b>\n", $stmt->error);
					} else {
					echo "<b>Purchase Added</b>";
					}
			}
			//session_unset();

			//session_destroy();

			//echo "<script type=\"text/javascript\">document.location.href=\"login.php\";</script>";
		}
	}
	elseif (isset($_POST["cancel"]) && $_POST["cancel"] ==  "CANCEL") {

			//move to shopping cart page
		echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";
			//})
	}
}
}

?>

<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<title> CPSC 304 - Shopping Cart </title>

	<link href="styles.css" rel="stylesheet" type="text/css">

</head>
<body>

	<nav id="nav01"></nav>
	<script src="Script.js"></script>

	<form id="checkout" name="checkout" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table border=0 cellpadding=0 cellspacing=0>
			<tr><td>Credit Card Number</td><td><input type="text" size=30 name="new_CC_number"</td></tr>
			<tr><td>Expiry Date</td><td><input type="date" size=30 name="new_expiry_date"</td></tr>
			<tr><td></td><td><input type="submit" name="checkout" border=0 value="CONFIRM"></td></tr>
			<tr><td></td><td><input type="submit" name="cancel" border=0 value="CANCEL"></td></tr>
		</table>
	</form>
</body>
</html>