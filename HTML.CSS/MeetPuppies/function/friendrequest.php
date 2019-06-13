<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(filter_has_var(INPUT_POST, 'addfriend')){
		if(filter_has_var(INPUT_POST, 'sender') && filter_has_var(INPUT_POST, 'reciever')){
			$sender 	= $_POST['sender'];
			$reciever 	= $_POST['reciever'];
			$pageurl 	= $_POST['pageurl'];
			$conn = Konekcija::get();

			$query = $conn->prepare("INSERT INTO FriendRequest VALUES(null,$sender,$reciever)");
			$result = $query->execute();

			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
		}
	}

	if(filter_has_var(INPUT_POST, 'cancelrequest')){
		if(filter_has_var(INPUT_POST, 'sender') && filter_has_var(INPUT_POST, 'reciever')){
			$sender 	= $_POST['sender'];
			$reciever 	= $_POST['reciever'];
			$pageurl 	= $_POST['pageurl'];
			$conn = Konekcija::get();

			$query = $conn->prepare("DELETE FROM FriendRequest WHERE Reciever = {$reciever} AND Sender = {$sender}");
			$result = $query->execute();

			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
		}
	}

	if(filter_has_var(INPUT_POST, 'declinerequest')){
		if(filter_has_var(INPUT_POST, 'sender') && filter_has_var(INPUT_POST, 'reciever')){
			$sender 	= $_POST['sender'];
			$reciever 	= $_POST['reciever'];
			$pageurl 	= $_POST['pageurl'];
			$conn = Konekcija::get();

			$query = $conn->prepare("DELETE FROM FriendRequest WHERE Reciever = {$reciever} AND Sender = {$sender}");
			$result = $query->execute();

			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
		}
	}

	if(filter_has_var(INPUT_POST, 'acceptrequest')){
		if(filter_has_var(INPUT_POST, 'sender') && filter_has_var(INPUT_POST, 'reciever')){
			$sender 	= $_POST['sender'];
			$reciever 	= $_POST['reciever'];
			$pageurl 	= $_POST['pageurl'];
			$conn   = Konekcija::get();

			$query  = $conn->query("INSERT INTO Friendship VALUES(null,$sender,$reciever)");
			$query2 = $conn->query("INSERT INTO Friendship VALUES(null,$reciever,$sender)");
			$query3 = $conn->query("SELECT Users.RealName,Users.UserId FROM Users JOIN Friendship ON Users.UserId = Friendship.User2 WHERE Friendship.User1 = {$sender} AND Friendship.User2 = {$reciever}");
			$userresult = $query3->fetchAll(PDO::FETCH_OBJ);
			$username = $userresult[0]->RealName;
			$query4 = $conn->query("INSERT INTO Notifications VALUES(null,null,'{$username} accepted your friend request',{$sender},{$reciever},NOW(),null)");
			$query1 = $conn->query("DELETE FROM FriendRequest WHERE Reciever = {$reciever} AND Sender = {$sender}");
			

			if($query && $query2){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
		}
	}

	if(filter_has_var(INPUT_POST, 'unfriend')){
		if(filter_has_var(INPUT_POST, 'sender') && filter_has_var(INPUT_POST, 'reciever')){
			$sender 	= $_POST['sender'];
			$reciever 	= $_POST['reciever'];
			$pageurl 	= $_POST['pageurl'];
			$conn = Konekcija::get();

			$query1 = $conn->prepare("DELETE FROM Friendship WHERE User1 = {$sender} AND User2 = {$reciever}");
			$result = $query1->execute();
			$query2 = $conn->prepare("DELETE FROM Friendship WHERE User2 = {$sender} AND User1 = {$reciever}");
			$result1 = $query2->execute();
			$query3 = $conn->query("DELETE FROM Notifications WHERE (NotUserId = {$sender} AND NotUser1Id = {$reciever}) OR (NotUserId = {$reciever} AND NotUser1Id = {$sender})");

			if($result && $result1){
				header("location:{$pageurl}");
			}
		}
	}