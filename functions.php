<!--
	code from: http://v3.thewatchmakerproject.com/journal/276/building-a-simple-php-shopping-cart
-->
<?php

function writeShoppingCart() {
	$cart = $_SESSION['cart'];
	if (!$cart) {
		return '<p>You have no items in your shopping cart</p>';
	} else {
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		return '<p>You have <a href="shoppingcart.php">'.count($items).' item'.$s.' in your shopping cart</a></p>';
	}
}

function showCart() {
	$db_host = 'localhost';
	$db_username = 'root';
	$db_password = 'K7lp8tt3pksql';
	$db_name = 'CPSC304';
	$connection = new mysqli($db_host, $db_username, $db_password, $db_name);
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="shoppingcart.php?action=update" method="post" id="cart">';
		$total = 0;
		$output[] = '<table>';
		$output[] = '<table border=0 cellpadding=0 cellspacing=0>';
		$output[] = '<tr valign=center>';
		$output[] = '<th class=rowheader>Product Code</th>';
		$output[] = '<th class=rowheader>Title</th>';
		$output[] = '<th class=rowheader>Type</th>';
		$output[] = '<th class=rowheader>Category</th>';
		$output[] = '<th class=rowheader>Stock</th>';
		$output[] = '<th class=rowheader>Price</th>';
		$output[] = '</tr>';
		foreach ($contents as $id=>$qty) {
			$sql = 'SELECT * FROM ITEM WHERE upc = '.$id;
			$result = $connection->query($sql);
			$row = $result->fetch_assoc();
			$price = $row['price'];
			$output[] = '<tr align=center>';
			$output[] = '<td>'. $row['upc'] .'</td>';
			$output[] = '<td>'. $row['title'] .'</td>';
			$output[] = '<td>'. $row['type'] .'</td>';
			$output[] = '<td>'. $row['category'] .'</td>';
			$output[] = '<td>'. $row['stock'] .'</td>';
			$output[] = '<td>&dollar;' .$row['price'].'</td>';
			$output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" size="3" maxlength="3" /></td>';
			$output[] = '<td>&dollar;'.($price * $qty).'</td>';
			$total += $price * $qty;
			$output[] = '<td><a href="shoppingcart.php?action=delete&id='.$id.'" class="r">Remove</a></td>';
			$output[] = '</tr>';
		}
		$output[] = '</table>';
		$output[] = '<p>Grand total: &dollar;'.$total.'</p>';
		$output[] = '<div><button type="submit">Update cart</button></div>';
		$output[] = '</form>';
	} else {
		$output[] = '<p>You shopping cart is empty.</p>';
	}
	return join('',$output);
}
?>