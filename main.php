<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 - Login</title>
<!--
	stylesheet
-->
	<link href="main.css" rel="stylesheet" type="text/css">

</head>

<body>

<?php
	//detect the user action
	//case1: first visit or refresh
	//case2: clicked the login button
	//case3: clicked the register button

	//check if the request method is post and evaluate the if statements
	if($_SERVER["REQUEST_METHOD"] == 'POST') {
		//echo "<script type=\"text/javascript\">document.location.href=\"xampp\";</script>";
		if (isset($_POST["login"]) && $_POST["login"] ==  "LOGIN") {
			echo "<script type=\"text/javascript\">document.location.href=\"xampp\";</script>";
		}
		if (isset($_POST["register"]) && $_POST["register"] ==  "REGISTER") {
			echo "<script type=\"text/javascript\">document.location.href=\"xampp\";</script>";
		}
	}
?>

<h1> Login </h1>
<!--
	Handling the user login/registration
-->
<form id="login" name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Book Title ID</td><td><input type="text" size=30 name="new_customer_ID"</td></tr>
        <tr><td>Book Title</td><td><input type="text" size=30 name="new_password"</td></tr>
        <tr><td></td><td><input type="submit" name="login" border=0 value="LOGIN"></td></tr>
        <tr><td></td><td><input type="submit" name="register" border=0 value="REGISTER"></td></tr>
    </table>
</form>

</body>
</html>