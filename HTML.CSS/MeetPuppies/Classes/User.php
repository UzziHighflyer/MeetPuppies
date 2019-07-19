<?php
	class User {
		private $id;
		private $fullname;
		private $email;
		private $password;
		private $birthdate;
		private $gender;
		private $profilepicture;
		private $city;
		private $country;
		private $datecreated;
		private $isonline;


		// Properties 

		public function setId($id){
			$this->id =	$id;
		}

		public function getId(){
			return $this->id;
		}

		public function setFullname($fullname){
			$this->fullname =	$fullname;
		}

		public function getFullname(){
			return $this->fullname;
		}

		public function setEmail($email){
			$this->email =	$email;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setPassword($password){
			$this->password =	$password;
		}

		public function getPassword(){
			return $this->password;
		}

		public function setBirthdate($birthdate){
			$this->birthdate = $birthdate;
		}

		public function getBirthdate(){
			return $this->birthdate;
		}

		public function setGender($gender){
			$this->gender = $gender;
		}
		public function getGender(){
			return $this->gender;
		}

		public function setProfilepicture($profilepicture){
			$this->profilepicture = $profilepicture;
		}
		public function getProfilepicture(){
			return $this->profilepicture;
		}

		public function setCity($city){
			$this->city = $city;
		}
		public function getCity(){
			return $this->city;
		}

		public function setCountry($country){
			$this->country = $country;
		}
		public function getCountry(){
			return $this->country;
		}

		public function setDatecreated($datecreated){
			$this->datecreated = $datecreated;
		}

		public function getDatecreated(){
			return $this->datecreated;
		}

		public function setOnlineStatus($isonline){
			$this->isonline = $isonline;
		}
		
		public function getOnlineStatus(){
			return $this->isonline;
		}

	}