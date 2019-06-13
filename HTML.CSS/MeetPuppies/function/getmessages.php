<?php
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(isset($_GET['user1']) && isset($_GET['user2'])){
		$conn = Konekcija::get();
		$user1 = $_GET['user1'];
		$user2 = $_GET['user2'];
		$query = $conn->query("SELECT Messages.*, Users.RealName, Users.ProfilePicture FROM Messages JOIN Users ON SenderId = Users.UserId WHERE SenderId = {$user1} AND RecieverId = {$user2} OR SenderId = {$user2} AND RecieverId = {$user1}");
		$query3 = $conn->query("SELECT Chat.MessageSeen,Chat.LastMessageUserId  FROM Chat WHERE User1 = {$user2} AND User2 = {$user1}");
        $checkIfSeen = $query3->fetchAll(PDO::FETCH_OBJ); 
		$messages = $query->fetchAll(PDO::FETCH_OBJ);

		if(!empty($messages)){
			for ($i=0; $i < count($messages) ; $i++) { 
				?>
					<p><img src="image.php?img=<?=$messages[$i]->ProfilePicture?>" alt="<?=$messages[$i]->RealName?>" style="width:50px"><b> <?=$messages[$i]->RealName?></b> : <?=$messages[$i]->MessageContent?><span class="w3-right"><?=$messages[$i]->TimeSent?></span></p>
				<?php 
			}
			if(!empty($checkIfSeen)){
				if($checkIfSeen[0]->MessageSeen == 1 && $checkIfSeen[0]->LastMessageUserId == $user1){
				?>
					<div class="w3-container">
                        <i class="fas fa-check-double w3-text-teget"></i> Seen
                    </div>
				<?php
				}
			}
		}else{
			?>
				<p>This chat is empty</p>
			<?php
		}
	}

