<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';
	// require '../Classes/User.php';

	if(filter_has_var(INPUT_POST, 'changepassword')){
		if(filter_has_var(INPUT_POST,'oldpassword') && filter_has_var(INPUT_POST, 'reoldpassword') && filter_has_var(INPUT_POST, 'newpassword')){
			$oldpassword	= $_POST['oldpassword'];
			$reoldpassword  = $_POST['reoldpassword'];
			$newpassword	= $_POST['newpassword'];
			$userid			= $_POST['userid'];
			$pageurl		= $_POST['pageurl'];

			if($reoldpassword == $oldpassword){
				$conn = Konekcija::get();
				$query = $conn->query("SELECT UserId,PasswordUser FROM Users WHERE UserId = {$userid}");
				$row = $query->fetchAll(PDO::FETCH_OBJ);
				if(password_verify($oldpassword, $row[0]->PasswordUser)){
					$newpassword = password_hash($newpassword, PASSWORD_BCRYPT);
					$upit  = $conn->prepare("UPDATE Users SET PasswordUser = :newpassword WHERE UserId = {$row[0]->UserId}");
					$result = $upit->execute(array(':newpassword'=>$newpassword));
					if($result){
						header("location:{$pageurl}");
					}else{
						header("location:{$pageurl}");
					}
				}else{
					header("location:{$pageurl}");
				}
			}
		}
	}

	if(filter_has_var(INPUT_POST, 'changename')){
		if(filter_has_var(INPUT_POST,'newname')){
			$newname  		= $_POST['newname'];
			$userid 		= $_POST['userid'];
			$pageurl		= $_POST['pageurl'];

			$conn = Konekcija::get();
			$query = $conn->prepare("UPDATE Users SET RealName = :newname WHERE UserId = {$userid}");
			$result = $query->execute(array(':newname'=>$newname));
			if($result){
				header("location:{$pageurl}");
			}else{
				header("location:{$pageurl}");
			}
		}
	}

	if(filter_has_var(INPUT_POST, 'changeprofilepicture')){
		if (isset($_FILES['profilepicture']) && !empty($_FILES['profilepicture']['name'])) {
			
			$userid 	= $_POST['userid'];
			$pageurl	= $_POST['pageurl'];
			$ime 		= $_FILES['profilepicture']['name'];
			$dozvoljeneEkstenzije = ['jpg','jpeg','png'];
			$ekstenzija = explode('.', $ime);
			$velicina  	= $_FILES['profilepicture']['size'];

			if(in_array($ekstenzija[1], $dozvoljeneEkstenzije) && $velicina < 500000){
				$picture 	= uniqid() . $_FILES['profilepicture']['name'];
				move_uploaded_file($_FILES['profilepicture']['tmp_name'],UPLOAD_PATH.$picture);

			}else{
				$picture= "slika.jpg";
			}
			
			$conn  = Konekcija::get();
			$query = $conn->query("UPDATE Users SET ProfilePicture = '{$picture}' WHERE UserId = {$userid}");

			if($query){
				header("location:{$pageurl}");				
			}	
		}else{
			$picture 	= "slika.jpg";
			$userid 	= $_POST['userid'];
			$pageurl	= $_POST['pageurl'];

			$conn  = Konekcija::get();
			$query = $conn->query("UPDATE Users SET ProfilePicture = '{$picture}' WHERE UserId = {$userid}");

			if($query){
				header("location:{$pageurl}");				
			}	
		}
		
	}