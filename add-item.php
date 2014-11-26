<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 - Add Item</title>

<link href="styles.css" rel="stylesheet" type="text/css">

</head>

<body>

<?php

	//start session
	session_start();
	//mysql connection
	include_once("config.php");

	// Check that the connection was successful, otherwise exit
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

	//detect the user action
	//case1: first visit or refresh
	//case2: clicked the Add button with input in unit price
	//case3: clicked the add button without input in unit price

	//check if the request method is post and evaluate the if statements
	if($_SERVER["REQUEST_METHOD"] == 'POST') {
		//echo "<script type=\"text/javascript\">document.location.href=\"xampp\";</script>";
		if (isset($_POST["submit"]) && $_POST["submit"] ==  "ADD") {
			//echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";
		


			//get the Customer_ID and password via POST
			$UPC = $_POST['new_upc'];
			$Quantity = $_POST['new_quantity'];
			$Unitprice = $_POST['new_unit_price'];
			//Create a INSERT query prepared statement with ? for customer ID and password
			
			//if unit price is set then insert it
			if($Unitprice != 0) {
			
			$stmt = $connection->prepare("UPDATE ITEM SET stock = stock + ?, price = ? WHERE upc = ?");
			$stmt->bind_param("idi", $Quantity, $Unitprice, $UPC);

			//execute the statement
			$stmt->execute();

			//echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";
			}
			// if unit price is set only insert upc and stock
			else{
			$stmt = $connection->prepare("UPDATE ITEM SET stock = stock + ? WHERE upc = ?");
			$stmt->bind_param("ii", $Quantity, $UPC);
			$stmt->execute();

			//echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";
			}
			
			}
		
	}
?>

<h1> Add Item </h1>
<!--
	Handling the user login/registration
-->
<form id="login" name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border=0 cellpadding=0 cellspacing=0>
        <tr><td>UPC</td><td><input type="text" size=30 name="new_upc"</td></tr>
        <tr><td>Quantity</td><td><input type="text" size=30 name="new_quantity"</td></tr>
		   <tr><td>Unit Price</td><td><input type="text" size=30 name="new_unit_price"</td></tr>
		   <tr><td></td><td><input type="submit" name="submit" border=0 value="ADD"></td></tr>
    </table>
</form>
</body>
</html>
