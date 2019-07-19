<?php
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	if(isset($_POST['creategroup'])){
		if(filter_has_var(INPUT_POST, 'groupname') && filter_has_var(INPUT_POST, 'groupdescription')){
			$groupname 			= $_POST['groupname'];
			$groupdescription   = $_POST['groupdescription'];
			$pageurl 			= $_POST['pageurl'];
			$userid 			= $_POST['userid'];
			
			if (isset($_FILES['profilepicture']) && !empty($_FILES['profilepicture']['name'])) {
                    $ime = $_FILES['profilepicture']['name'];
                    $dozvoljeneEkstenzije = ['jpg','jpeg','png'];
                    $ekstenzija = explode('.', $ime);
                    $velicina   = $_FILES['profilepicture']['size'];


                    if(in_array($ekstenzija[1], $dozvoljeneEkstenzije) && $velicina < 500000){
                        $picture    = uniqid() . $_FILES['profilepicture']['name'];
                        move_uploaded_file($_FILES['profilepicture']['tmp_name'],UPLOAD_PATH.$picture);
                    }else{
                        $picture= "slika.jpg";
                    }   
            }else{
                $picture    = "slika.jpg";
            }

            $conn   = Konekcija::get();
            $query  = $conn->prepare("INSERT INTO Groups VALUES(null,:groupname,:groupdescription,:picture,:userid)");
            $query->execute(array(':groupname' => $groupname,':groupdescription' => $groupdescription,'picture' => $picture,'userid' => $userid));
            $groupid = $conn->lastInsertId();
            $query2 = $conn->query("INSERT INTO GroupMembers VALUES(null,{$userid},{$groupid})");

            if($query && $query2){
            	header("location:{$pageurl}");
            }else{
            	header("location:{$pageurl}");
            }
		}
	}