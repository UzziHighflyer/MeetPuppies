<?php 
	
	if(isset($_GET['id']) && is_numeric($_GET['id'])){
		$id   = $_GET['id'];
	}
	$conn = Konekcija::get();
	
	$sql  = "SELECT * FROM Users WHERE UserId = :id";
	$execute = $conn->prepare($sql);
	$execute->execute(array(':id'=>$id));
	$userrow = $execute->fetchAll(PDO::FETCH_OBJ);

	if(!empty($userrow)){
		$user1 = new User;
		$user1->setId($id);
		$user1->setFullname($userrow[0]->RealName);
		$user1->setEmail($userrow[0]->Mail);
		$user1->setPassword($userrow[0]->PasswordUser);
		$user1->setBirthDate($userrow[0]->BirthDate);
		$user1->setGender($userrow[0]->Gender);
		$user1->setCity($userrow[0]->City);
		$user1->setCountry($userrow[0]->Country);
		$user1->setProfilepicture($userrow[0]->ProfilePicture);
		$user1->setDatecreated($userrow[0]->DateCreate);	
	}
