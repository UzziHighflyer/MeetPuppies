<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';

	function reArrayFiles($filePost){
		$fileArray = [];
		$fileCount = count($filePost['name']);
		$fileKeys  = array_keys($filePost);

		for ($i=0; $i < $fileCount ; $i++) { 
			foreach ($fileKeys as $key) {
				$fileArray[$i][$key] = $filePost[$key][$i];
			}
		}

		return $fileArray;
	}


	if(isset($_POST['addpetpictures'])){
		if(isset($_FILES['pictures'])){
			$userid = $_POST['userid'];
			$petid 	= $_POST['petid'];
			$pageurl = $_POST['pageurl'];
			$files = reArrayFiles($_FILES['pictures']);
			$dozvoljeneEkstenzije = ['jpg','jpeg','png'];
			
			for ($i=0; $i < count($files); $i++) { 
				$ime = $files[$i]["name"];
				$tmp_name = $files[$i]["tmp_name"];
				$ekstenzija = explode('.', $ime);
				$velicina  	= $files[$i]['size'];
				
				if(in_array($ekstenzija[1],$dozvoljeneEkstenzije) && $files[$i]['error'] == 0 && $velicina < 500000){
					$picture = uniqid() . $ime;
					move_uploaded_file($tmp_name,UPLOAD_PATH.$picture);
					$conn = Konekcija::get();
					$query = $conn->query("INSERT INTO PetImages VALUES(null,'{$picture}',{$petid},{$userid})");
					
					if($query){
						header("location:{$pageurl}");
					}else{
						echo 'jebiga';
					}
				}
			}
		}

	}