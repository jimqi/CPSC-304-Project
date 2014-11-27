<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 - Register </title>

<link href="styles.css" rel="stylesheet" type="text/css">

</head>

<body>

<nav id="nav01"></nav>
<script src="Script.js"></script>

<?php
	//setup connection
	include_once("config.php");
	//$connection = $_SESSION['connection'];

	// Check that the connection was successful, otherwise exit
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    //detect the user action
	//case1: first visit or refresh
	//case2: clicked the confirm button

    //check if the request method is post and evaluate the if statements
    if($_SERVER["REQUEST_METHOD"] == "POST") {

    	if(isset($_POST["confirm"]) && $_POST["confirm"] == 'CONFIRM') {
    		//inserting new tuple into customer table

			//get the Customer_ID and password via POST
			$Customer_ID = $_POST['new_customer_ID'];
			$Password = $_POST['new_password'];
			$Name = $_POST['new_name'];
			$Address = $_POST['new_address'];
			$Phonenumber = $_POST['new_phonenumber'];
			
                        //Create a INSERT query prepared statement with ? for customer ID and password
			$stmt = $connection->prepare("INSERT INTO Customer (cid, password, name, address, phone) VALUES (?, ?, ?, ?, ?)");
			
                        //bind the customer ID and password passed via POST
			if(isset($Customer_ID) && isset($Password) && isset($Name) && isset($Address) && isset($Phonenumber)) {
			$stmt->bind_param("isssi", $Customer_ID, $Password, $Name, $Address, $Phonenumber);

			//execute the statement
			$stmt->execute();

			echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";

    	}
    }
}

?>
<!--
	Registration Form
-->
<h1> Registration </h1>

<form id="login" name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Customer ID</td><td><input type="text" size=30 name="new_customer_ID"</td></tr>
        <tr><td>Password</td><td><input type="text" size=30 name="new_password"</td></tr>
        <tr><td>Name</td><td><input type="text" size=30 name="new_name"</td></tr>
        <tr><td>Address</td><td><input type="text" size=30 name="new_address"</td></tr>
        <tr><td>Phone Number</td><td><input type="text" size=30 name="new_phonenumber"</td></tr>
        <tr><td></td><td><input type="submit" name="confirm" border=0 value="CONFIRM"></td></tr>
    </table>
</form>

</body>
</html>