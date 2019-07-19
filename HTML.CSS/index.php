<?php  
	if(file_exists('MeetPuppies/config.php')){
		header('location:MeetPuppies/index.php');
	}

?><!DOCTYPE html>
<html>
<head>
	<title>Install MeetPuppies</title>
	<link rel="stylesheet" type="text/css" href="MeetPuppies/w3-style.css">
	<link rel="stylesheet" type="text/css" href="MeetPuppies/style.css">

</head>
<body>
	<div class="w3-top">
		<div class="w3-bar w3-theme-nasa w3-left-align w3-large w3-padding">
			<h1>Welcome to installation wizard for MeetPuppies</h1>	
		</div>
	</div>
	<form action="installation.php" method="POST" class="w3-padding w3-third">
		<input type="text" name="dbname" placeholder="Database Name"  class="w3-input" required><br>
		<input type="text" name="dbhost" placeholder="Database Host"  class="w3-input" required><br>
		<input type="text" name="dbusername" placeholder="Database username"  class="w3-input" required><br>
		<input type="text" name="dbpassword" placeholder="Database password"  class="w3-input" required><br>
		<input type="text" name="datapath" placeholder="Select path to directory (e.g. /var/www/html)"  class="w3-input" required> <br>
		<small class="w3-small">*Make sure you have valid permissions in this directory</small> <br>
		<input type="submit" name="createSchema" value="Create Schema" class="w3-button w3-teget w3-hover-nasapink">
	</form>
</body>
</html>