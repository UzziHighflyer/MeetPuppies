<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';


	
	if(isset($_POST['postid'])){
		$postid 	= $_POST['postid'];
		$pageurl 	= $_POST['pageurl'];
		$conn 		= Konekcija::get();
		$query  	= $conn->query("DELETE  FROM Posts WHERE PostsId = {$postid}");
		$query1 	= $conn->query("DELETE  FROM Likes WHERE PostID = {$postid}"); 
		$query2 	= $conn->query("DELETE  FROM Comments WHERE PostID = {$postid}");
		$query3 	= $conn->query("DELETE  FROM Notifications WHERE NotPostId = {$postid}");

		if($query){
			header("location:{$pageurl}");
		}
	}
	
