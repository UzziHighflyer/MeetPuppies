<?php 
	session_start();
	require '../config.php';
	require '../Classes/autoload.php';


	if (isset($_POST['add'])) {
        if(isset($_POST['petname']) && isset($_POST['race']) && isset($_POST['dateofbirth']) && isset($_POST['gender']) && isset($_POST['rate']) && isset($_POST['typeof']) && isset($_POST['about'])){
            if(!empty($_POST['petname']) && !empty($_POST['race']) && !empty($_POST['dateofbirth']) && !empty($_POST['gender']) && !empty($_POST['rate']) && !empty($_POST['typeof']) && !empty($_POST['about'])){
                $conn = Konekcija::get();
                $petname            = $_POST['petname'];
                $race               = $_POST['race'];
                $dateofbirth        = date("Y-m-d",strtotime($_POST['dateofbirth']));
                $gender             = $_POST['gender'];
                $rate               = $_POST['rate'];
                $typeof             = $_POST['typeof'];
                $about              = $_POST['about'];
                $vaccinated         = isset($_POST['vaccinated'])?1:0;
                $chipped            = isset($_POST['chipped'])?1:0;
                $tournament         = isset($_POST['tournament'])?1:0;
                $userid             = $_POST['userid'];

                if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
                    $ime = $_FILES['picture']['name'];
                    $dozvoljeneEkstenzije = ['jpg','jpeg','png'];
                    $ekstenzija = explode('.', $ime);
                    $velicina   = $_FILES['picture']['size'];


                    if(in_array($ekstenzija[1], $dozvoljeneEkstenzije) && $velicina < 500000){
                        $picture    = uniqid() . $_FILES['picture']['name'];
                        move_uploaded_file($_FILES['picture']['tmp_name'],UPLOAD_PATH.$picture);
                    }else{
                        $picture= "petsslika.jpg";
                    }   
                }else{
                    $picture    = "petsslika.jpg";
                }
                
                //UPIT ZA UNOSENJE PODATAKA U TABELU

                $sql    = "INSERT INTO Pets VALUES(null,:petname,:dateofbirth,:gender,:picture,NOW(),:race,:chipped,:vaccinated,:rate,:tournament,:about,:typeof,:userid)";
                $query  = $conn->prepare($sql);
                $result = $query->execute(array(':petname' => $petname , ':dateofbirth' => $dateofbirth, ':gender' => $gender, ':picture' => $picture, ':race' => $race, ':chipped' => $chipped, ':vaccinated' => $vaccinated , ':rate' => $rate ,':tournament' => $tournament , ':about' => $about , ':typeof' => $typeof, ':userid' => $userid));
                if($result){
                    unset($_POST['add']);
                    header('Location:../profil.php');
                    
                }else{
                    unset($_POST['add']);
                    header('Location:../profil.php');
                }
            }
        }
    }