<?php
	class Group {
		private $id;
		private $groupname;
		private $description;
		private $grouppicture;
		private $groupadminid;

		// Properties 

		public function setId($id){
			$this->id =	$id;
		}

		public function getId(){
			return $this->id;
		}

		public function setGroupname($groupname){
			$this->groupname =	$groupname;
		}

		public function getGroupname(){
			return $this->groupname;
		}

		public function setDescription($description){
			$this->description = $description;
		}

		public function getDescription(){
			return $this->description;
		}
		
		public function setGrouppicture($grouppicture){
			$this->grouppicture =	$grouppicture;
		}

		public function getGrouppicture(){
			return $this->grouppicture;
		}

		public function setGroupAdmin($groupadminid){
			$this->groupadminid =	$groupadminid;
		}

		public function getGroupadmin(){
			return $this->groupadminid;
		}



	}