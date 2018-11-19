<!DOCTYPE html>
<html>
	<head>
		<title> SongOrganizer </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
<body>
	<?php
	$file = fopen("contact_data.csv","r");
	
	print_r(fgetcsv($file));
	fclose($file);
	?>




</body>
</html>
