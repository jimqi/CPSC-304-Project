<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 - Login</title>

<link href="styles.css" rel="stylesheet" type="text/css">

</head>

<body>
<ul>
  <li><a href="login.php">Customer Login</a></li>
  <li><a href="manager.php">Manager</a></li>
  <li>Clerk</li>
</ul>

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
	//case1: first visit or refresh
	//case2: clicked the login button
	//case3: clicked the register button

	//check if the request method is post and evaluate the if statements
	if($_SERVER["REQUEST_METHOD"] == 'POST') {
		if (isset($_POST["login"]) && $_POST["login"] ==  "LOGIN") {
			$_SESSION['CID'] = $_POST['new_customer_ID'];
			echo "<script type=\"text/javascript\">document.location.href=\"shoppingcart.php\";</script>";
		}
		elseif (isset($_POST["register"]) && $_POST["register"] ==  "REGISTER") {

			//move to registration page (register.php)
			echo "<script type=\"text/javascript\">document.location.href=\"register.php\";</script>";
			//}
		}
	}
?>

<h1> Login </h1>
<!--
	Handling the user login/registration
-->
<form id="login" name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Customer ID</td><td><input type="text" size=30 name="new_customer_ID" value="Customer ID" </td></tr>
        <tr><td>Password</td><td><input type="password" size=30 name="new_password"</td></tr>
        <tr><td></td><td><input type="submit" name="login" border=0 value="LOGIN"></td></tr>
        <tr><td></td><td><input type="submit" name="register" border=0 value="REGISTER"></td></tr>
    </table>
</form>

</body>
</html>
