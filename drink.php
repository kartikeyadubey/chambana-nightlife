<?php
include 'db.php';

if (isset($_POST['drink_submit']))
    insert_drink();

if (isset($_GET['delete']))
    delete_drink();
//else
    //display_feedback_prompt($type);

?>
<html>
<body>
<h3>Drinks</h3>
<?php
display_drinks()
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);?>" method="post" enctype="multipart/form-data">
<!-- Each object has a name and image file with a hidden maximum size for the image -->

<?php
    
    echo '<form name="drink_form" action="'.htmlentities($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']).'" method="post" enctype="multipart/form-data">';
    
    echo 'Drink Name: <input type="text" name="drink_name"/><br />';
    echo '<textarea name="drink_description" rows="4" cols="60">Enter drink description here.</textarea><br />';
    echo '<input type="submit" name="drink_submit" value="Submit"/>';
    echo '</form>';

?>

</body>
</html>
<?php 

function insert_drink() {

	dbConnect();
    $sql = "INSERT INTO drink (name, description) VALUES
            ('".protect_against_injection($_POST['drink_name'])."', '".protect_against_injection($_POST['drink_description'])."')";
    
    if(!mysql_query($sql))
        echo '<div class="fail">Could not create drink.  ' . mysql_error() .'</div>';
    else
        echo '<div class="success">Drink successfully created.</div>';
}

function display_drinks() {

	dbConnect();
	// sending query
	$result = mysql_query("SELECT * FROM drink");
	if (!$result) {
		die("Query to show fields from table failed" . mysql_error());
	}

	$fields_num = mysql_num_fields($result);

	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++)
	{
		$field = mysql_fetch_field($result);
		echo "<td>{$field->name}</td>";
	}
	echo "</tr>\n";
	// printing table rows
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";

		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		$displayDelete = true;
		foreach($row as $cell) {
			if($displayDelete) {
				echo "<td>$cell <a href=\"drink.php?delete=$cell\"> DELETE </a></td>";
				$displayDelete = false;
			}
			else echo "<td>$cell</td>";
		}
		$displayDelete = true;
		echo "</tr>\n";
	}
	mysql_free_result($result);
}

// Deletes a drink from the database
// The drink to delete is obtained from the url
function delete_drink() {
    // Connect to the database so we can send our query
    dbConnect();

    // Obtain the drink to delete from the url and form the query
    $drinkName = protect_against_injection($_GET['delete']);
    $sql = "DELETE FROM drink WHERE name='".$drinkName."'";

    // Display feedback on whether the query was successful
    if(!mysql_query($sql))
        echo '<div class="fail">Could not delete drink. ' . mysql_error() .'</div>';
    else
    echo '<div class="success">Drink successfully deleted.</div>';
}

?>