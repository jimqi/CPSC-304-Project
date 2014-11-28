<?php
require_once("config.php");
require_once("functions.php");
?>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<title> CPSC 304 - Tables </title>

	<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
});
</script>
</head>
<body>
	<div class="tabs">
		<ul class="tab-links">
			<li class="active"><a href="#tab1">Tab #1</a></li>
			<li><a href="#tab2">Tab #2</a></li>
			<li><a href="#tab3">Tab #3</a></li>
			<li><a href="#tab4">Tab #4</a></li>
		</ul>

		<div class="tab-content">
			<div id="tab1" class="tab active">
						<body>
						<h2>Search Results</h2>
					<!-- Set up a table to view the book titles -->
					<table border=0 cellpadding=0 cellspacing=0>
					<!-- Create the table column headings -->

					<tr valign=center>
					<td class=rowheader>Upc</td>
					<td class=rowheader>Title</td>
					<td class=rowheader>Type</td>
					<td class=rowheader>Category</td>
					<td class=rowheader>Company</td>
					<td class=rowheader>Year</td>
					<td class=rowheader>Price</td>
					<td class=rowheader>Stock</td>
					</tr>
					</body>
			
				<?php
					$sql = "SELECT * FROM ITEM";
					$result = $connection->query($sql);
					if ($result->num_rows == 0){
						echo ("No Results");
					}
					while($row = $result->fetch_assoc()){
						echo "<form id='search' name='search' action=\"";
						echo htmlspecialchars($_SERVER["PHP_SELF"]);
						echo "\" method=\"POST\">";
						echo "<td>".$row['upc']."</td>";
						echo "<td>".$row['title']."</td>";
						echo "<td>".$row['type']."</td>";
						echo "<td>".$row['category']."</td>";
						echo "<td>".$row['company']."</td>";
						echo "<td>".$row['year']."</td>";
						echo "<td>".$row['price']."</td>";
						echo "<td>".$row['stock']."</td>";
	
				?>
			</div>

			<div id="tab2" class="tab">
			
				<body>
						<h2>Search Results</h2>
					<!-- Set up a table to view the book titles -->
					<table border=0 cellpadding=0 cellspacing=0>
					<!-- Create the table column headings -->

					<tr valign=center>
					<td class=rowheader>Upc</td>
					<td class=rowheader>Name</td>
					</tr>
					</body>
				<?php
					$sql = "SELECT * FROM LEADSINGER";
					$result = $connection->query($sql);
					if ($result->num_rows == 0){
						echo ("No Results");
					}
					while($row = $result->fetch_assoc()){
						echo "<form id='search' name='search' action=\"";
						echo htmlspecialchars($_SERVER["PHP_SELF"]);
						echo "\" method=\"POST\">";
						echo "<td>".$row['upc']."</td>";
						echo "<td>".$row['name']."</td>";
				?>
			</div>

			<div id="tab3" class="tab">
			
			<body>
						<h2>Search Results</h2>
					<!-- Set up a table to view the book titles -->
					<table border=0 cellpadding=0 cellspacing=0>
					<!-- Create the table column headings -->

					<tr valign=center>
					<td class=rowheader>Upc</td>
					<td class=rowheader>Title</td>
					</tr>
					</body>
				<?php
					$sql = "SELECT * FROM HASSONG";
					$result = $connection->query($sql);
					if ($result->num_rows == 0){
						echo ("No Results");
					}
					while($row = $result->fetch_assoc()){
						echo "<form id='search' name='search' action=\"";
						echo htmlspecialchars($_SERVER["PHP_SELF"]);
						echo "\" method=\"POST\">";
						echo "<td>".$row['upc']."</td>";
						echo "<td>".$row['title']."</td>";
				?>
			</div>

			<div id="tab4" class="tab">
			
			<body>
						<h2>Search Results</h2>
					<!-- Set up a table to view the book titles -->
					<table border=0 cellpadding=0 cellspacing=0>
					<!-- Create the table column headings -->

					<tr valign=center>
					<td class=rowheader>CID</td>
					<td class=rowheader>Password</td>
					<td class=rowheader>Name</td>
					<td class=rowheader>Address</td>
					<td class=rowheader>Phone</td>
					</tr>
					</body>
				<?php
					$sql = "SELECT * FROM CUSTOMER";
					$result = $connection->query($sql);
					if ($result->num_rows == 0){
						echo ("No Results");
					}
					while($row = $result->fetch_assoc()){
						echo "<form id='search' name='search' action=\"";
						echo htmlspecialchars($_SERVER["PHP_SELF"]);
						echo "\" method=\"POST\">";
						echo "<td>".$row['cid']."</td>";
						echo "<td>".$row['password']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['address']."</td>";
						echo "<td>".$row['phone']."</td>";
	
				?>
			</div>
		</div>
	</div>
</body>
</html>
