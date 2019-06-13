<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(isset($_GET['user1'])){
		$conn = Konekcija::get();
		$user = $_GET['user1'];

		$query = $conn->query("SELECT * FROM Chat WHERE User1 = {$user} OR User2 = {$user}");
		$chats = $query->fetchAll(PDO::FETCH_OBJ);

		if(!empty($chats)){
			for ($c=0; $c < count($chats); $c++) { 
				?>
					<a href="#" class="w3-bar-item w3-button"><?=$chats[$c]->LastMessage?></a>
				<?php
			}
		}
	}