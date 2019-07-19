<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(filter_has_var(INPUT_POST, 'postcomment')){
		$postcomment 	= $_POST['postcomment'];		
		$postid 	 	= $_POST['postid'];
		$pageurl  	 	= $_POST['pageurl'];
		$usercomment 	= $_POST['usercomment'];
		$usercommented 	= $_POST['usercommented'];

		$postcontent = filter_var($postcomment,FILTER_SANITIZE_STRING);
		$conn = Konekcija::get();

		$query = $conn->prepare("INSERT INTO Comments VALUES(null,:postcomment,:userid,:postid,NOW())");
		$result = $query->execute(array(':postcomment'=>$postcomment,':userid'=> $usercomment,':postid'=>$postid));
		$commentid 		= $conn->lastInsertId();
		$query1 = $conn->query("SELECT Users.RealName From Users WHERE UserId = {$usercomment}");
		$user   = $query1->fetchAll(PDO::FETCH_OBJ);
		if(!empty($user)){
			$query2 = $conn->prepare("INSERT INTO Notifications VALUES(null,{$postid},'{$user[0]->RealName} commented your post',{$usercommented},{$usercomment},NOW(),{$commentid})");
			$query2->execute();
		}

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}

	if(filter_has_var(INPUT_POST, 'selfpostcomment')){
		$selfpostcomment 	= $_POST['selfpostcomment'];
		$userid		 		= $_POST['userid'];
		$postid 	 		= $_POST['postid'];
		$pageurl  	 		= $_POST['pageurl'];


		$postcontent = filter_var($selfpostcomment,FILTER_SANITIZE_STRING);
		$conn = Konekcija::get();

		$query = $conn->prepare("INSERT INTO Comments VALUES(null,:selfpostcomment,:userid,:postid,NOW())");
		$result = $query->execute(array(':selfpostcomment'=>$selfpostcomment,':userid'=> $userid,':postid'=>$postid));

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}
