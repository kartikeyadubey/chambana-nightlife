<?php
include "config.php"; 

mysql_connect($server, $db_user, $db_pass) or die (mysql_error()); 
$result = mysql_db_query($database, "select * from $table order by id desc") or die (mysql_error()); 

if (mysql_num_rows($result)) { 
   echo "list of users:<ul>"; 
   while ($qry = mysql_fetch_array($result)) { 
      echo "<li>$qry[username]</li>"; 
   } 
   echo "</ul>end list of users."; 
}
?>