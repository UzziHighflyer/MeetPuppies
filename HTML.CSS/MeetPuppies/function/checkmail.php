<?php 
	require '../config.php';
	require '../Classes/autoload.php';
		
	if(isset($_POST['emailvalue'])){
		$conn 	= Konekcija::get();
		$email  = $_POST['emailvalue'];
		$sql 	= "SELECT Mail FROM Users WHERE Mail =':email'";
		$query  = $conn->prepare($sql);
		$query->execute(array(':email'=>$email));

		$result = $query->fetchAll(PDO::FETCH_OBJ);

		if(!empty($result)){
			echo "nemoze";
  
		}else{ 
			echo "moze";    
		}

	}