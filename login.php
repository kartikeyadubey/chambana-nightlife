<?php
ob_start();

include("db.php"); 

// Connect to the database
dbConnect();
// Read the data from table called Users

$table = "Users";

$match = "select id from $table where username = '".$_POST['username']."' 
and password = '".$_POST['password']."';"; 

$qry = mysql_query($match) 
or die ("Could not match data because ".mysql_error()); 
$num_rows = mysql_num_rows($qry); 

if ($num_rows <= 0) { 
echo "Sorry, there is no username $username with the specified password.<br>"; 
echo "<a href=login.html>Try again</a>"; 
exit; 
} else { 

setcookie("loggedin", "TRUE", time()+(3600 * 24));
setcookie("mysite_username", "$username");
echo "You are now logged in!<br>"; 
echo "Continue to the <a href=members.php>members</a> section."; 
}
ob_end_flush();
?>