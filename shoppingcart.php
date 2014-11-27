<?php
session_start();
require_once("config.php");
require_once("functions.php");
$cart = $_SESSION['cart'];
if(isset($_GET['action'])) {
	$action = $_GET['action'];
}

//CASE1: Adding an item upc
//CASE2: Deleting an item upc
//CASE3: Updating item qty
//CASE4: Moving to checkout
if(isset($_GET['action'])) {
	switch ($action) {
		case 'add':
		if ($cart) {
			$cart .= ','.$_GET['id'];
		} else {
			$cart = $_GET['id'];
		}
		$_SESSION['cart'] = $cart;
		break;
		case 'delete':
		if ($cart) {
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newcart != '') {
						$newcart .= ','.$item;
					} else {
						$newcart = $item;
					}
				}
			}
			$cart = $newcart;
			$_SESSION['cart'] = $cart;
		}
		break;
		case 'update':
		if ($cart) {
			$newcart = '';
			foreach ($_POST as $key=>$value) {
				if (stristr($key,'qty')) {
					$id = str_replace('qty','',$key);
					$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
					$newcart = '';
					foreach ($items as $item) {
						if ($id != $item) {
							if ($newcart != '') {
								$newcart .= ','.$item;
							} else {
								$newcart = $item;
							}
						}
					}
					for ($i=1;$i<=$value;$i++) {
						if ($newcart != '') {
							$newcart .= ','.$id;
						} else {
							$newcart = $id;
						}
					}
				}
			}
		}
		$cart = $newcart;
		$_SESSION['cart'] = $cart;
		break;
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

<!--
	Navigation Bar
-->
<nav id="nav01"></nav>	
<script src="Script.js"></script>

<div id="shoppingcart">

	<h1>Your Shopping Cart</h1>

	<?php
	echo writeShoppingCart();
	?>

</div>

<div id="contents">

</tr>
<?php
echo showCart();
echo bill();
?>

</div>

<FORM METHOD="LINK" ACTION="checkout.php">
	<INPUT TYPE="submit" VALUE="CHECKOUT">
	</FORM>

</body>
</html>