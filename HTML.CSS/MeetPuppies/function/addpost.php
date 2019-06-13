<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(filter_has_var(INPUT_POST, 'postcontent')){
		$postcontent = $_POST['postcontent'];
		$postphoto   = null;
		$userid		 = $_POST['userid'];
		$pageurl     = $_POST['pageurl'];

		$postcontent = filter_var($postcontent,FILTER_SANITIZE_STRING);
		$conn = Konekcija::get();

		$query = $conn->prepare("INSERT INTO Posts VALUES(null,:postcontent,:postphoto,NOW(),:userid)");
		$result = $query->execute(array(':postcontent'=>$postcontent,':postphoto'=> $postphoto,':userid'=>$userid));

		if($result){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}


	}
