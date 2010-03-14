<html>
<head>
<title>Members' Section</title>
</head>

<body>

<?php
if (!isset($_COOKIE['loggedin'])) die("You are not logged in!<br><a href=login.html>log in</a>");
echo "You are now in the members section <p>";
?>

<a href="drink.php">Click here for Drink info</a><br />
<a href="bar.php">Click here for Bar info</a><br />
<a href="logout.php">Log out</a>

</body>
</html>