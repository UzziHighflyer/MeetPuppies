<?php  
	require '../config.php';
	require '../Classes/autoload.php';
	// LOGIN

	if (filter_has_var(INPUT_POST, 'email') && filter_has_var(INPUT_POST, 'password')) {
		$email 	  = $_POST['email'];
		$password = $_POST['password'];

		$email    = filter_var($email,FILTER_SANITIZE_EMAIL);
		$password = filter_var($password,FILTER_SANITIZE_STRING);

		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$conn = Konekcija::get();
			$query = $conn->prepare("SELECT * FROM Users WHERE Mail = :email");
			$query->execute(array(':email' => $email));
			$row = $query->fetchAll(PDO::FETCH_OBJ);

			if (empty($row)) {
				echo "email";
			}else{
				if (password_verify($password, $row[0]->PasswordUser)) {
					session_start();
					$_SESSION['id']       		= $row[0]->UserId;
					$_SESSION['fullname'] 		= $row[0]->RealName;
					$_SESSION['email'] 	  		= $row[0]->Mail;
					$_SESSION['password'] 		= $row[0]->PasswordUser;
					$_SESSION['gender']   		= $row[0]->Gender;
					$_SESSION['birthdate']		= $row[0]->BirthDate;
					$_SESSION['city']			= $row[0]->City;
					$_SESSION['country']		= $row[0]->Country;
					$_SESSION['datecreated']	= $row[0]->DateCreate;
					$_SESSION['profilepicture'] = $row[0]->ProfilePicture;
					$_SESSION['loggedin'] 		= 1;

					
					echo "logedin";
				}else{
					echo "password";
				}
			}
		}else{
			echo "nonvalidmail";
		}
	}else{
		echo "required";
	}
	