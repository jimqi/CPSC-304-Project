<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 Store - Manage</title>
    <link href="styles.css" rel="stylesheet" type="text/css">

<!-- Javascript to submit a title_id as a POST form, used with the "delete" links -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("p").hide();
  });
  $("#show").click(function(){
    $("p").show();
  });
});
</script>

</head>

<body>
<h1>Registration</h1>
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
    
    // user actions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST["submit"]) && $_POST["submit"] == "ADD_STOCK") {
          $upc = $_POST["upc"];
          $price = $_POST['new_price'];
          $newstock = $_POST['add_stock'];

          if (!$currentStock = $connection->query("SELECT stock
          				           FROM Item
                                                   WHERE upc=".$upc)) {
                   die('There was an error running the query [' . $db->error . ']');
          }

          $stmt = $connection->prepare("UPDATE Item
                                        SET stock = ".$currentStock + $newstock."
                                            && price = CASE
                                                           WHEN ".$price."IS NOT NULL
                                                                THEN ".$price."
                                                                ELSE price
                                        WHERE upc = ".$upc);
                                        // INSERT INTO Customer (cid, password, name, address, phone) VALUES (?,?,?,?,?)");

          // Bind the parameters
          //$stmt->bind_param("iii", $upc, $price, $stock);
          
          // Execute the insert statement
          $stmt->execute();
          
          if($stmt->error) {
            printf("<b>Error: %s.</b>\n", $stmt->error);
          } else {
            echo "<b>Successfully added ".$name."</b>";
          }
       }
    }
?>

<h2>Add Stock</h2>
<form id="add" name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table border=0 cellpadding=0 cellspacing=0>
           <tr><td>UPC:</td><td><input type="number" size=30 name="upc"</td></tr>
           <tr><td>Price (optional):</td><td> <input type="number" name="new_price"></td></tr>
           <tr><td>Quantity:</td><td> <input type="number" size=4 name="add_stock"></td></tr>
           <tr><td></td><td><input type="submit" name="submit" border=0 value="ADD_STOCK"></td></tr>
    </table>
</form>

<!-- TODO?
<h2>Process Order Delivery</h2>
<form id="process" name="process" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table border=0 cellpadding=0 cellspacing=0>
        <tr><td>UPC:</td><td><input type="text" size=30 name="new_upc"</td></tr>
        <tr><td>Title:</td><td><input type="text" size=30 name="new_title"</td></tr>
	<tr><td></td><td><input type="submit" name="submit" border=0 value="PROCESS"></td></tr>
    </table>
</form>
-->


<h2>Generate Sales Report</h2>
<form id="generate" name="generate" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Date:</td><td><input type="text" size=30 name="date"</td></tr>
	<tr><td></td><td><input type="submit" name="submit" border=0 value="GENERATE"></td></tr>
    </table>
</form>

<h2>Sales Report</h2>
<table border=0 cellpadding=0 cellspacing=0>
       <tr valign=center>
           <td class=rowheader>UPC</td>
           <td class=rowheader>Category</td>
           <td class=rowheader>Unit Price</td>
           <td class=rowheader>Units</td>
           <td class=rowheader>Total Value</td>
       </tr>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST["submit"]) && $_POST["submit"] == "GENERATE") {
          $date = $_POST["date"];
          
          // Select what to display
          if (!$result = $connection->query("SELECT upc, category, price, quantity
					     FROM Item, Orderr, PurchaseItem
					     WHERE date=".$date."
                                             GROUP BY category")) {
                   die('There was an error running the query [' . $db->error . ']');
          }
          
          $quantitySold;
          $totalSales;
          $prevCategory;
          $currUnits; // counts category units
          $currVal; // counts category total value

          // Display each book title database row as a table row
          while($row = $result->fetch_assoc()){
            $totalVal = $row['price']*$row['quantity'];

            if ($prevCategory != $row['category']) {
              echo "<tr><td><br /></td>";
              echo "<td>Total:</td>";
              echo "<td><br /></td>";
              echo "<td>".$currUnits."</td>";
              echo "<td>".$currVal."</td>";
              
              // compute total daily sales values: quantity and price
              $quantitySold += $currUnits;
              $totalSales += $currVal;

              // reset values for next category
              $currUnits = 0;
              $currVal = 0;
            }

            echo "<tr><td>".$row['upc']."</td>";
            echo "<td>".$row['category']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>".$row['quantity']."</td>";
            echo "<td>".$totalVal."</td></tr>";

            $prevCategory = $row['category']; // set category for comparison
            $currUnits += $row['quantity'];
            $currVal += $totalVal;
          }

          echo "<tr><td align=right>--------</td></tr>";
          echo "<tr align=right><td>Total Daily Sales:</td>";
          echo "<td>".$quantitySold."</td>";
          echo "<td>".$totalSales."</td></tr>";
       }
    }

    // Close the connection to the database once we're done with it.
    mysqli_close($connection);
?>

</table>

</body>
</html>