<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(filter_has_var(INPUT_POST,'commentbutton')){
		if(filter_has_var(INPUT_POST,'commentcontent'))
			$commentcontent	= $_POST['commentcontent'];		
			$postid 	 	= $_POST['postid'];
			$pageurl  	 	= $_POST['pageurl'];
			$userid		 	= $_POST['userid'];
			$conn = Konekcija::get();

			$query   = $conn->prepare("INSERT INTO GroupComments VALUES(null,:commentcontent,{$userid},{$postid},NOW())");
			$result  = $query->execute(array(':commentcontent' => $commentcontent));

			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
	}

	if (filter_has_var(INPUT_POST, 'deletecommentbutton')) {
		$commentid 		= $_POST['commentid'];
		$pageurl 		= $_POST['pageurl'];
		$conn 			= Konekcija::get();

		$query = $conn->query("DELETE  FROM GroupComments WHERE GroupCommentId = {$commentid}");

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}	
	}