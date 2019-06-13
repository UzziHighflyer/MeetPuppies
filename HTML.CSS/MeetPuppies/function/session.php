<?php
	if(!file_exists('config.php')){
		header('location:../index.php');
	}

	$dir =  dirname(__FILE__);
    $dir = explode('/', $dir);

    $parent = $dir[count($dir)-1];

   

	if($parent == 'function'){
		require 'Classes/autoload.php';
		require 'config.php';
		require 'Classes/Konekcija.php';
	}
	else{
		require '../Classes/autoload.php';
		require '../config.php';
		require '../Classes/Konekcija.php';
	}

	if(!isset($_SESSION)){	
		session_start();
		$user 	= new User;
		$user->setId($_SESSION['id']);
		$user->setFullname($_SESSION['fullname']);		
		$user->setEmail($_SESSION['email']);
		$user->setPassword($_SESSION['password']);
		$user->setBirthDate($_SESSION['birthdate']);
		$user->setGender($_SESSION['gender']);
		$user->setCity($_SESSION['city']);
		$user->setCountry($_SESSION['country']);
		$user->setProfilepicture($_SESSION['profilepicture']);
		$user->setDatecreated($_SESSION['datecreated']);
	}
	if(!$_SESSION['loggedin']){
		session_destroy();
		header('location:index.php');
		
	}

