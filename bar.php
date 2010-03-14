<?php

include 'db.php';

if (isset($_POST['bar_submit']))
    insert_bar();
    
if (isset($_GET['delete']))
    delete_bar();

//else
    //display_feedback_prompt($type);

?>
<html>
<body>
<h3>Bars</h3>
<?php
display_bars()
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);?>" method="post" enctype="multipart/form-data">
<!-- Each object has a name and image file with a hidden maximum size for the image -->

<?php
    // Create the form to input the data
    echo '<form name="bar_form" action="'.htmlentities($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']).'" method="post" enctype="multipart/form-data">';
    
    echo 'Bar: <input type="text" name="bar_name"/><br />';
    echo '<textarea name="bar_description" rows="4" cols="60">Enter Bar description here.</textarea><br />';
    echo 'Rating: <select name="bar_rating">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            </select></br>';
    echo '<textarea name="bar_specials" rows="4" cols="60">Enter Bar Specials here.</textarea><br />';
    echo '<textarea name="bar_address" rows="3" cols="60">Enter Bar Address here.</textarea><br />';
    echo '<input type="submit" name="bar_submit" value="Submit"/>';
    echo '</form>';

?>

</body>
</html>
<?php 

// Insert Bar information using data from the form

function insert_bar() {

	dbConnect();
    
    // Get the data from the form and insert into the bar table
    $sql = "INSERT INTO bar (name, rating, description, specials, address) VALUES
            ('".protect_against_injection($_POST['bar_name'])."','".protect_against_injection($_POST['bar_rating']).
             "','".protect_against_injection($_POST['bar_description'])."',
                '".protect_against_injection($_POST['bar_specials'])."','".protect_against_injection($_POST['bar_address'])."')";
    
    if(!mysql_query($sql))
        echo '<div class="fail">Could not create bar.  ' . mysql_error() .'</div>';
    else
        echo '<div class="success">Bar successfully created.</div>';
}

// Display all the data stored in the bar table
function display_bars() {

	dbConnect();
	// sending query
	$result = mysql_query("SELECT * FROM bar");
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
				echo "<td>$cell <a href=\"bar.php?delete=$cell\"> DELETE </a></td>";
				$displayDelete = false;
			}
			else echo "<td>$cell</td>";
		}
		$displayDelete = true;
		echo "</tr>\n";
	}
	mysql_free_result($result);
}

// Deletes a bar from the database
// The bar to delete is obtained from the url
function delete_bar() {
    // Connect to the database so we can send our query
    dbConnect();

    // Obtain the bar to delete from the url and form the query
    $barName = protect_against_injection($_GET['delete']);
    $sql = "DELETE FROM bar WHERE name='".$barName."'";

    // Display feedback on whether the query was successful
    if(!mysql_query($sql))
        echo '<div class="fail">Could not delete bar. ' . mysql_error() .'</div>';
    else
    echo '<div class="success">Bar successfully deleted.</div>';
}



?>