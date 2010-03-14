<?php // create a mysql connection and connect to the specified database (if one is specified)
function dbConnect($db="") {
    // credentials
    include 'local.php';
   
   // if no database is specified, set the default database
   if ($db == "")
       $db = "CS411_data";
   
   // try to create general mysql connection
   $connection = mysql_connect($host, $db_user, $db_pass);
   if (!$connection)
       die('The site database is down right now. ' . mysql_error());
   
   // try to connect to the given database
   if ($db!="" and !mysql_select_db($db))
       die('The site database is unavailable.' . mysql_error());
   
   // return the connection pointer
   return $connection;
}

function protect_against_injection($string) {
    if (!get_magic_quotes_gpc())
        $string = mysql_real_escape_string($string);
    return $string;
}
?>