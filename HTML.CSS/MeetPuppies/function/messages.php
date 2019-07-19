<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	
		if(filter_has_var(INPUT_POST,'messagecontent')){
			$messagecontent = $_POST['messagecontent'];
			$sender   	 	= $_POST['sender'];
			$reciever  		= $_POST['reciever'];
			$pageurl   		= $_POST['pageurl'];
			$now 			= date("Y-m-d H:i:s");

			$conn   = Konekcija::get();
			$query  = $conn->prepare("INSERT INTO Messages VALUES(null,{$sender},{$reciever},:messagecontent,'{$now}')");
			$result = $query->execute(array(':messagecontent'=>$messagecontent));

			$query2 = $conn->query("SELECT * FROM Chat WHERE User1 = {$sender} AND User2 = {$reciever}");
			$chat   = $query2->fetchAll(PDO::FETCH_OBJ);
			if(empty($chat)){
				$query3 = $conn->prepare("INSERT INTO Chat VALUES(null,{$sender},{$reciever},:lastmessage,{$sender},'{$now}',0)");
				$query3->execute(array(':lastmessage' => $messagecontent ));
				$query5 = $conn->prepare("INSERT INTO Chat VALUES(null,{$reciever},{$sender},:lastmessage,{$sender},'{$now}',0)");
				$query5->execute(array(':lastmessage' => $messagecontent ));
			}else{
				$query4 = $conn->prepare("UPDATE Chat SET LastMessage = :lastmessage, LastMessageUserId = {$sender},LastMessageTimeSent = '{$now}', MessageSeen = 1 WHERE User1 = {$sender} AND User2 = {$reciever}");
				$query4->execute(array(':lastmessage' => $messagecontent));
				
				$query6 = $conn->prepare("UPDATE Chat SET LastMessage = :lastmessage, LastMessageUserId = {$sender},LastMessageTimeSent = '{$now}', MessageSeen = 0 WHERE User1 = {$reciever} AND User2 = {$sender}");
				$query6->execute(array(':lastmessage' => $messagecontent));
			}

			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
			
		}
	