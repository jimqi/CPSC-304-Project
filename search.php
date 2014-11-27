<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 - Search Item</title>



<!--
	stylesheet
-->
	<link href="search.css" rel="stylesheet" type="text/css">
	
</head>

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
<td class=rowheader>Name</td>
<td class=rowheader>Year</td>
<td class=rowheader>Price</td>
<td class=rowheader>Stock</td>
</tr>


<?php

			function populate($row) {
			echo "<form id='search' name='search' action=\"";
    echo htmlspecialchars($_SERVER["PHP_SELF"]);
    echo "\" method=\"POST\">";
        echo "<td>".$row['upc']."</td>";
       echo "<td>".$row['title']."</td>";
       echo "<td>".$row['type']."</td>";
	  echo "<td>".$row['category']."</td>";
	  echo "<td>".$row['name']."</td>";
	  echo "<td>".$row['year']."</td>";
      echo "<td>".$row['price']."</td>";
	  echo "<td>".$row['stock']."</td>";
	  echo "<td><input type='submit' name='submit' border=0 value='ADD'></td>";
	  echo "</td></tr>";
	global $input; 
	$input = $row['upc'];
	
	


	  

    }
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
		
	
	

	
		
		if (isset($_POST["submit"]) && $_POST["submit"] ==  "SEARCH") {


			$Category = $_POST['category'];
			$Title = $_POST['new_title'];
			$LeadingSinger = $_POST['new_leading_singer'];
			
	
		
			
			
			
	
			
			if (empty($Title) && empty($Category) && !empty($LeadingSinger)) {
			$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND leadsinger.name LIKE'{$LeadingSinger}')";
			$result = $connection->query($query);
							if ($result->num_rows == 0){
				echo ("No Results");
			}
			    while($row = $result->fetch_assoc()){
					populate($row);
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "</td></tr>";
    }
    echo "</form>";	
			}
			
			if (empty($Title) && empty($LeadingSinger) && !empty($Category)) {
			$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND item.category LIKE'{$Category}')";
			$result = $connection->query($query);
				if ($result->num_rows == 0){
				echo ("No Results");
			}
			    while($row = $result->fetch_assoc()){
					populate($row);
					
					
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
      // echo "</td></tr>";
    }
	
    echo "</form>";	
			}
			
					if (empty($Category) && empty($LeadingSinger) && !empty($Title)) {
			$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND item.title LIKE'{$Title}')";
			$result = $connection->query($query);
							if ($result->num_rows == 0){
				echo ("No Results");
			}
			    while($row = $result->fetch_assoc()){
					populate($row);
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
      // echo "</td></tr>";
    }
    echo "</form>";	
			}
			
					if (empty($Category) && !empty($Title) && !empty($LeadingSinger)) {
					
			$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND item.title LIKE '{$Title}' AND leadsinger.name LIKE '{$LeadingSinger}')";
			$result = $connection->query($query);
							if ($result->num_rows == 0){
				echo ("No Results");
			}
			    while($row = $result->fetch_assoc()){
					populate($row);
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
      // echo "</td></tr>";
    }
    echo "</form>";	
			}
			
			
					if (empty($LeadingSinger) && !empty($Title) && !empty($Category)) {
			$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND item.title LIKE '{$Title}' AND item.category LIKE '{$Category}')";
			$result = $connection->query($query);
					if ($result->num_rows == 0){
				echo ("No Results");
			}
			    while($row = $result->fetch_assoc()){
					populate($row);
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
      // echo "</td></tr>";
    }
    echo "</form>";	
			}
			
			
					if (empty($Title)&& !empty($LeadingSinger) && !empty($Category)) {
			$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND item.category LIKE '{$Category}' AND leadsinger.name LIKE '{$LeadingSinger}')";
			$result = $connection->query($query);
				if ($result->num_rows == 0){
				echo ("No Results");
			}
			    while($row = $result->fetch_assoc()){
					populate($row);
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
      // echo "</td></tr>";
    }
    echo "</form>";	
			}
			
			else if (!empty($Title)&& !empty($LeadingSinger) && !empty($Category)){
						$query = "SELECT * FROM item, leadsinger WHERE (leadsinger.upc = item.upc AND item.category LIKE '{$Category}' AND leadsinger.name LIKE '{$LeadingSinger}' AND item.title LIKE '{$Title}')";
			$result = $connection->query($query);
			if ($result->num_rows == 0){
				echo ("No Results");
				
			}
				
			    while($row = $result->fetch_assoc()){
					populate($row);
       //Display an option to delete this title using the Javascript function and the hidden title_id
      // echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
      // echo "</td></tr>";
    }
    echo "</form>";	
			
			}
			
					  if (isset($_POST["submit"]) && $_POST["submit"] ==  "ADD") {
			  echo ($input);
	
		}
			
			
			
			
			
		
		
	}

	}
?>
</table>
<h1> Search Options </h1>
<!--
	Handling the user login/registration
-->
<form id="search" name="search" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Category</td><td>
		    <select name = "category" id = "category">
		   <option value = "rock"> Rock </option>
		   <option value = "pop"> Pop </option>
		   <option value = "rap"> Rap </option>
		   <option value = "country"> Country </option>
		   <option value = "classical"> Classical </option>
		   <option value = "new_age"> New Age </option>
		   <option value = "instrumental"> Instrumental </option>
		   <option value = ""> No Category </option>
		   </select>
        <tr><td>Title</td><td><input type="text" size=30 name="new_title"</td></tr>
		   <tr><td>Leading Singer</td><td><input type="text" size=30 name="new_leading_singer"</td></tr>
		   <tr><td></td><td><input type="submit" name="submit" border=0 value="SEARCH"></td></tr>		   
    </table>
</form>
</body>
</html>
