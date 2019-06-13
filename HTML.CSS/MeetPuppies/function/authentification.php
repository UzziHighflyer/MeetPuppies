<?php
	require '../config.php';
	require '../Classes/autoload.php';

		if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['city']) && isset($_POST['country']) && isset($_POST['dateofbirth']) && isset($_POST['gender'])){
			if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['city']) && !empty($_POST['country']) && !empty($_POST['dateofbirth']) && !empty($_POST['gender'])){
				$conn = Konekcija::get();
				$fullname 		= $_POST['fullname'];
				$email 	  		= $_POST['email'];
				$password 		= password_hash($_POST['password'],PASSWORD_BCRYPT);
				$city     		= $_POST['city'];
				$country  		= $_POST['country'];
				$gender 		= $_POST['gender'];
				$dateofbirth  	= date("Y-m-d",strtotime($_POST['dateofbirth']));

				$query1  = $conn->prepare("SELECT Mail FROM Users WHERE Mail =:email");
				$query1->execute(array(':email'=>$email));
				$result1 = $query1->fetchAll(PDO::FETCH_OBJ);

				
				if(empty($result1)){
					if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
						$ime = $_FILES['picture']['name'];
						$dozvoljeneEkstenzije = ['jpg','jpeg','png'];
						$ekstenzija = explode('.', $ime);
						$velicina  	= $_FILES['picture']['size'];

						if(in_array($ekstenzija[1], $dozvoljeneEkstenzije) && $velicina < 500000){
							$picture 	= uniqid() . $_FILES['picture']['name'];
							move_uploaded_file($_FILES['picture']['tmp_name'],UPLOAD_PATH.$picture);

						}else{
							$picture= "slika.jpg";
						}	
					}else{
						$picture 	= "slika.jpg";
					}
					
					//UPIT ZA UNOSENJE PODATAKA U TABELU

					$sql 	= "INSERT INTO Users VALUES(null,:fullname,:email,:password,:dateofbirth,:gender,:profilepicture,:city,:country,NOW())";
					$query  = $conn->prepare($sql);
					$result = $query->execute(array(':fullname' => $fullname , ':email' => $email, ':password' => $password, ':city' => $city, ':country' => $country, ':dateofbirth' => $dateofbirth , ':profilepicture' => $picture ,':gender' => $gender));
					if($result){
						echo "registered";
					}else{
						echo 1;
					}
				}else{
					echo "email";
				}
			}
		}

	
	

