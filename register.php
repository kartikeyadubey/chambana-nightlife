<?php 

include("db.php"); 

// Connect to the database
dbConnect();

// set $table to Users

$table = "Users";

// check if the username is taken
$check = "select id from $table where username = '".$_POST['username']."';"; 
$qry = mysql_query($check)
or die ("Could not match data because ".mysql_error());
$num_rows = mysql_num_rows($qry); 
if ($num_rows != 0) { 
echo "Sorry, there the username $username is already taken.<br>";
echo "<a href=register.html>Try again</a>";
exit; 
} else {

// insert the data
$insert = mysql_query("insert into $table values ('NULL', '".$_POST['username']."', '".$_POST['password']."')")
or die("Could not insert data because ".mysql_error());

// print a success message
echo "Your user account has been created!<br>"; 
echo "Now you can <a href=login.html>log in</a>"; 
}

?>