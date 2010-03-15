<html>
<head>
<title>CU Nightlife: Drinks</title>
</head>
<body>

	<?php
	$this->load->helper('form');
	echo form_open_multipart('drink/create');
	echo 'Drink Name ' . form_input('name', '').'<br />';
	echo form_textarea('description', 'Description goes here').'<br />';
	echo form_submit('drink_submit', 'Create Drink!');
	echo form_close();
	?>
	
</body>
</html>