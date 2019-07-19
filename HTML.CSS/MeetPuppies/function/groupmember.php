<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(filter_has_var(INPUT_POST, 'joingroup')){
		$userid   = $_POST['userid'];
		$groupid  = $_POST['groupid'];
		$pageurl  = $_POST['pageurl'];
		$conn     = Konekcija::get();

		$query    = $conn->query("INSERT INTO GroupRequest VALUES(null,{$userid},{$groupid})");

		if($query){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}

	if(filter_has_var(INPUT_POST, 'cancelrequest')){
		$userid   = $_POST['userid'];
		$groupid  = $_POST['groupid'];
		$pageurl  = $_POST['pageurl'];
		$conn     = Konekcija::get();

		$query    = $conn->query("DELETE FROM GroupRequest WHERE GroupRequestUserId = {$userid} AND GroupRequestGroupId = {$groupid}");

		if($query){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}

	if(filter_has_var(INPUT_POST, 'acceptrequest')){
		$userid   = $_POST['userid'];
		$groupid  = $_POST['groupid'];
		$pageurl  = $_POST['pageurl'];
		$conn     = Konekcija::get();

		$query    = $conn->query("DELETE FROM GroupRequest WHERE GroupRequestUserId = {$userid} AND GroupRequestGroupId = {$groupid}");
		$query2   = $conn->query("INSERT INTO GroupMembers VALUES(null,{$userid},{$groupid})");

		if($query && $query2){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}

	if(filter_has_var(INPUT_POST, 'declinerequest')){
		$userid   = $_POST['userid'];
		$groupid  = $_POST['groupid'];
		$pageurl  = $_POST['pageurl'];
		$conn     = Konekcija::get();

		$query    = $conn->query("DELETE FROM GroupRequest WHERE GroupRequestUserId = {$userid} AND GroupRequestGroupId = {$groupid}");

		if($query){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}

	if(filter_has_var(INPUT_POST, 'leavegroup')){
		$userid   = $_POST['userid'];
		$groupid  = $_POST['groupid'];
		$pageurl  = $_POST['pageurl'];
		$conn     = Konekcija::get();

		$query    = $conn->query("DELETE FROM GroupMembers WHERE GroupUserId = {$userid} AND GroupId = {$groupid}");

		if($query){
			header("location:{$pageurl}");
		}else{
			header("location:{$pageurl}");
		}
	}



