<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>CPSC 304 Store-Register</title>
<!--
    A simple stylesheet is provided so you can modify colours, fonts, etc.
-->
    <link href="bookbiz.css" rel="stylesheet" type="text/css">

<!--
    Javascript to submit a title_id as a POST form, used with the "delete" links
-->
<script>
function formSubmit(titleId) {
    'use strict';
    if (confirm('Are you sure you want to delete this title?')) {
      // Set the value of a hidden HTML element in this form
      var form = document.getElementById('delete');
      form.title_id.value = titleId;
      // Post this form
      form.submit();
    }
}
</script>
</head>

<body>
<h1>Registration</h1>
<?php
    /****************************************************
     STEP 1: Connect to the bookbiz MySQL database
     ****************************************************/

    // CHANGE this to connect to your own MySQL instance in the labs or on your own computer
    $connection = new mysqli("dbserver.ugrad.cs.ubc.ca", "cs304_student", "goStudentFindData", "bookbiz");

    // Check that the connection was successful, otherwise exit
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    /****************************************************
     STEP 2: Detect the user action

     Next, we detect what the user did to arrive at this page
     There are 3 possibilities 1) the first visit or a refresh,
     2) by clicking the Delete link beside a book title, or
     3) by clicking the bottom Submit button to add a book title
     
     NOTE We are using POST superglobal to safely pass parameters
        (as opposed to URL parameters or GET)
     ****************************************************/

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (isset($_POST["submitDelete"]) && $_POST["submitDelete"] == "DELETE") {
       /*
          Delete the selected book title using the title_id
        */
       
       // Create a delete query prepared statement with a ? for the title_id
       $stmt = $connection->prepare("DELETE FROM titles WHERE title_id=?");
       $deleteTitleID = $_POST['title_id'];
       // Bind the title_id parameter, 's' indicates a string value
       $stmt->bind_param("s", $deleteTitleID);
       
       // Execute the delete statement
       $stmt->execute();
          
       if($stmt->error) {
         printf("<b>Error: %s.</b>\n", $stmt->error);
       } else {
         echo "<b>Successfully deleted ".$deleteTitleID."</b>";
       }
            
      } elseif (isset($_POST["submit"]) && $_POST["submit"] ==  "ADD") {       
       /*
        Add a book title using the post variables title_id, title and pub_id.
        */
        $customer_id = $_POST["cid"];
        $password = $_POST["password"];
        $name = $_POST["name"];
		$address = $_POST['address'];
		$phone_number = $_POST['phone'];
          
        $stmt = $connection->prepare("INSERT INTO Customer (cid, password, name, address, phone) VALUES (?,?,?,?,?)");
          
        // Bind the title and pub_id parameters, 'sss' indicates 3 strings
        $stmt->bind_param("sssss", $customer_id, $password, $name, $address, $phone_number);
        
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

<h2>Book Titles in alphabetical order</h2>
<!-- Set up a table to view the book titles -->
<table border=0 cellpadding=0 cellspacing=0>
<!-- Create the table column headings -->

<tr valign=center>
<td class=rowheader>Title ID</td>
<td class=rowheader>Title</td>
<td class=rowheader>Publisher ID</td>
</tr>

<?php
    /****************************************************
     STEP 3: Select the most recent list of book titles
     ****************************************************/

   // Select all of the book rows columns title_id, title and pub_id
    if (!$result = $connection->query("SELECT cid, password, name, address, phone ORDER BY name")) {
        die('There was an error running the query [' . $db->error . ']');
    }

    // Avoid Cross-site scripting (XSS) by encoding PHP_SELF (this page) using htmlspecialchars.
    echo "<form id=\"delete\" name=\"delete\" action=\"";
    echo htmlspecialchars($_SERVER["PHP_SELF"]);
    echo "\" method=\"POST\">";
    // Hidden value is used if the delete link is clicked
    echo "<input type=\"hidden\" name=\"cid\" value=\"-1\"/>";
   // We need a submit value to detect if delete was pressed 
    echo "<input type=\"hidden\" name=\"submitDelete\" value=\"DELETE\"/>";


    /****************************************************
     STEP 4: Display the list of book titles
     ****************************************************/
    // Display each book title databaserow as a table row
    while($row = $result->fetch_assoc()){
        
       echo "<td>".$row['name']."</td>";
       echo "<td>".$row['address']."</td>";
       echo "<td>".$row['phone']."</td><td>";
	   echo "<td>".$row['cid']."</td><td>";
		echo "<td>".$row['password']."</td><td>";
       
       //Display an option to delete this title using the Javascript function and the hidden title_id
       echo "<a href=\"javascript:formSubmit('".$row['cid']."');\">DELETE</a>";
       echo "</td></tr>";
        
    }
    echo "</form>";

    // Close the connection to the database once we're done with it.
    mysqli_close($connection);
?>

</table>

<h2>Add a New Book Title</h2>

<!--
  /****************************************************
   STEP 5: Build the form to add a book title
   ****************************************************/
    Use an HTML form POST to add a book, sending the parameter values back to this page.
    Avoid Cross-site scripting (XSS) by encoding PHP_SELF using htmlspecialchars.

    This is the simplest way to POST values to a web page. More complex ways involve using
    HTML elements other than a submit button (eg. by clicking on the delete link as shown above).
-->

<form id="add" name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table border=0 cellpadding=0 cellspacing=0>
        <tr><td>Name</td><td><input type="text" size=30 name="new_name"</td></tr>
        <tr><td>Address</td><td><input type="text" size=30 name="new_address"</td></tr>
        <tr><td>Phone Number:</td><td> <input type="text" size=5 name="new_phone"></td></tr>
		<tr><td>Customer Id:</td><td> <input type="text" size=5 name="new_cid"></td></tr>
		<tr><td>Password:</td><td> <input type="text" size=5 name="new_password"></td></tr>
        <tr><td></td><td><input type="submit" name="submit" border=0 value="ADD"></td></tr>
    </table>
</form>
</body>
</html>
