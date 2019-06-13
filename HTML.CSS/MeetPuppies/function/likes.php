<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(isset($_POST['likepost'])){
		$postid      = $_POST['postid'];
		$userlike    = $_POST['userlike'];
		$pageurl     = $_POST['pageurl'];
		$userliked   = $_POST['userliked'];

		$conn = Konekcija::get();

		$query = $conn->prepare("INSERT INTO Likes VALUES(null,{$postid},{$userlike})");
		$result = $query->execute();
		$query1 = $conn->query("SELECT Users.RealName From Users WHERE UserId = {$userlike}");
		$user   = $query1->fetchAll(PDO::FETCH_OBJ);
		if(!empty($user)){
			$query2 = $conn->prepare("INSERT INTO Notifications VALUES(null,{$postid},'{$user[0]->RealName} liked your post',{$userliked},{$userlike},NOW(),null)");
			$query2->execute();
		}

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}


	}
	
	if(isset($_POST['unlikepost'])){
		$postid      = $_POST['postid'];
		$userlike    = $_POST['userlike'];
		$pageurl     = $_POST['pageurl'];
		$likeid 	 = $_POST['likeid'];
		$userliked   = $_POST['userliked'];

		$conn = Konekcija::get();

		$query = $conn->prepare("DELETE FROM Likes WHERE LikeId = {$likeid}");
		$result = $query->execute();
		$query2 = $conn->prepare("DELETE FROM Notifications WHERE NotUser1id = {$userlike} AND NotPostId = {$postid}");
		$query2->execute();
		

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}


	}

	if(filter_has_var(INPUT_POST, 'likeyourpost')){
		$postid      = $_POST['postid'];
		$userlike    = $_POST['userlike'];
		$pageurl     = $_POST['pageurl'];

		$conn = Konekcija::get();

		$query = $conn->prepare("INSERT INTO Likes VALUES(null,{$postid},{$userlike})");
		$result = $query->execute();
		

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}


	}


	if(filter_has_var(INPUT_POST, 'unlikeyourpost')){
		$postid      = $_POST['postid'];
		$userlike    = $_POST['userlike'];
		$pageurl     = $_POST['pageurl'];
		$likeid 	 = $_POST['likeid'];
		$userliked   = $_POST['userliked'];

		$conn = Konekcija::get();

		$query = $conn->prepare("DELETE FROM Likes WHERE LikeId = {$likeid}");
		$result = $query->execute();
		

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}


	}
