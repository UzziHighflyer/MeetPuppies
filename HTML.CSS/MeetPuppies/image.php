<?php
	require 'config.php';
	header('Content-Type: image/png');
	header('Content-Type: image/jpg');
	header('Content-Type: image/jpeg');

	$folder = UPLOAD_PATH;

	if(file_exists($folder . $_GET['img'])){	
		readfile($folder. $_GET['img']);
	}else{
		echo "No such photo";
	}