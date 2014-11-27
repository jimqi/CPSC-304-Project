<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 - Return</title>

<!--
	stylesheet
-->
	<link href="login.css" rel="stylesheet" type="text/css">

</head>

<body>

<?php




	//start session
	session_start();
	//mysql connection
	include_once("config.php");
	

	







	
	
	
	
	


	//detect the user action
	//case1: first visit or refresh
	//case2: clicked the login button
	//case3: clicked the register button

	//check if the request method is post and evaluate the if statements
	if($_SERVER["REQUEST_METHOD"] == 'POST') {
		//echo "<script type=\"text/javascript\">document.location.href=\"xampp\";</script>";
		if (isset($_POST["return"]) && $_POST["return"] ==  "RETURN") {
		
		$ReceiptID = $_POST['new_receiptid'];
		$check  = "SELECT receiptId from purchaseitem WHERE receiptId = {$ReceiptID}";
		$result2 = $connection->query($check);
		
		
		$query  = "SELECT date from orderr WHERE receiptId = {$ReceiptID}";
		$result = $connection->query($query);
		$row    = $result->fetch_array();
		$now    = $row['date'];
		$time = strtotime($now);
		$mysqlidate =  date('Y-m-d',$time);
		
	
		if (mysqli_num_rows($result2) == 0 ) {
			echo ("Not a valid Receipt ID");
		}
		
		
		else if(strtotime($now)<strtotime('-15 days')) {
			echo ("It is past 15 days. Can't return item");
	 }
	 
	 else {
	 $rng = rand(0,99999);
	 $stmt = $connection->prepare("INSERT INTO returnn (retid) VALUES ({$rng})");
	 $stmt->execute();
	$stmt = $connection->prepare("UPDATE returnn SET receiptId = {$ReceiptID} WHERE retid = {$rng}");
	$stmt->execute();
	$stmt = $connection->prepare("UPDATE returnn SET date={$mysqlidate} WHERE retid = {$rng}");
	$stmt->execute();
	 $stmt = $connection->prepare("INSERT INTO returnitem (retid) VALUES ({$rng})");
	 $stmt->execute();
	 $stmt = $connection->prepare("INSERT INTO returnitem (retid, upc, quantity) SELECT returnn.retid, purchaseitem.upc, purchaseitem.quantity FROM returnn, purchaseitem WHERE purchaseitem.receiptId = returnn.receiptId");
	 $stmt->execute();	
	
			
			echo($mysqlidate);
	 }
		
		





		


	}
	}
	
	
?>





<h1> Return </h1>
<!--
	Handling the user login/registration
-->
<form id="add" name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Receipt ID</td><td><input type="text" size=30 name="new_receiptid"</td></tr>
        <tr><td></td><td><input type="submit" name="return" border=0 value="RETURN"></td></tr>
    </table>
</form>

</body>
</html>
