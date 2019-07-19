<?php
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';


	
	if(isset($_POST['deletecomment'])){
		$commentid 		= $_POST['commentid'];
		$pageurl 		= $_POST['pageurl'];
		$postid  		= $_POST['postid'];
		$usercommented  = $_POST['usercommented'];
		$usercomment    = $_POST['usercomment'];
		$conn 			= Konekcija::get();
		$query 			= $conn->prepare("DELETE  FROM Comments WHERE CommentId = {$commentid}");
		$result 		= $query->execute();
		$query1 		= $conn->prepare("DELETE FROM Notifications WHERE NotPostId = {$postid} AND NotUser1Id = {$usercomment} AND CommentId = $commentid");
		$query1->execute();

		if($result){
			header("location:{$pageurl}");
		}
	}

	if(isset($_POST['selfdeletecomment'])){
		$commentid 	= $_POST['commentid'];
		$pageurl 	= $_POST['pageurl'];
		$conn 		= Konekcija::get();
		$query 		= $conn->prepare("DELETE  FROM Comments WHERE CommentId = {$commentid}");

		$result 	= $query->execute();

		if($result){
			header("location:{$pageurl}");
		}
	}