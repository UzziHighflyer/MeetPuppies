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

		$query = $conn->query("INSERT INTO GroupLikes VALUES(null,{$postid},{$userlike})");

		if($query){
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

		$query = $conn->query("DELETE FROM GroupLikes WHERE GroupLikeId = {$likeid}");
		

		if($query){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}


	}