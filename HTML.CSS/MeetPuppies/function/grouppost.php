<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(filter_has_var(INPUT_POST, 'grouppost')){
		if(filter_has_var(INPUT_POST,'grouppostcontent')){
			$grouppostcontent = $_POST['grouppostcontent'];
			$pageurl 		  = $_POST['pageurl'];
			$groupid		  = $_POST['groupid'];
			$userid 		  = $_POST['userid'];
			$grouppostphoto   = null;
			$conn 			  = Konekcija::get();

			$query = $conn->prepare("INSERT INTO GroupPosts VALUES(null,:grouppostcontent,{$userid},{$groupid},'{$grouppostphoto}',NOW())");
			$result = $query->execute(array(':grouppostcontent'=>$grouppostcontent));

			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}

		}
	}

	if(filter_has_var(INPUT_POST, 'deletepost')){
		$postid  = $_POST['postid'];
		$pageurl = $_POST['pageurl'];
		$conn 	 = Konekcija::get();

		$query   = $conn->query("DELETE FROM GroupPosts WHERE GroupPostId = {$postid}");

		if($query){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
	}