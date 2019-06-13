<?php 
	
	if(isset($_GET['id']) && is_numeric($_GET['id'])){
		$id   = $_GET['id'];
	}
	$conn = Konekcija::get();
	
	$sql  		= "SELECT * FROM Groups WHERE GroupId = :id";
	$execute 	= $conn->prepare($sql);
	$execute->execute(array(':id'=>$id));
	$grouprow 	= $execute->fetchAll(PDO::FETCH_OBJ);

	if(!empty($grouprow)){
		$group = new Group;
		$group->setId($id);
		$group->setGroupname($grouprow[0]->GroupName);
		$group->setDescription($grouprow[0]->GroupDescription);
		$group->setGrouppicture($grouprow[0]->GroupPicture);
		$group->setGroupAdmin($grouprow[0]->GroupAdmin);	
	}
