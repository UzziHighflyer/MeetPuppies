<?php
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(isset($_POST['user1']) && $_POST['user2']){
		$user1 = $_POST['user1'];
		$user2 = $_POST['user2'];
		$conn = Konekcija::get();
		$query = $conn->query("UPDATE Chat SET MessageSeen = 1 WHERE User1 = {$user1} AND User2 = {$user2}");

	}