<?php  
	if(file_exists('MeetPuppies/config.php')){
		header('location:MeetPuppies/index.php');
	}

	if(isset($_POST['createSchema'])){
		if(isset($_POST['dbname'])&& isset($_POST['dbhost']) && isset($_POST['dbusername'])&& isset($_POST['dbpassword']) && $_POST['datapath']){
			$dbname 	 = $_POST['dbname'];
			$dbhost 	 = $_POST['dbhost'];
			$dbusername  = $_POST['dbusername'];
			$dbpassword  = $_POST['dbpassword'];
			$datapath    = $_POST['datapath']; 
			if(file_exists($datapath)){
				mkdir($datapath .'/MeetPuppiesImages',0755);
				try{	
					$conn = new PDO("mysql:host=".$dbhost,$dbusername,$dbpassword);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}catch(PDOException $e){
					if($e->getCode() == 2002){
						echo "Connection failed: Host doesn't exist or cannot be connected to. (Error No. {$e->getCode()})"; 
					}elseif ($e->getCode() == 1045) {
						echo "Connection failed: Wrong username or password. (Error No. {$e->getCode()})";
					}
					echo '<br><a href="index.php">Go back to installation wizard form.</a>';
				}
				$query = $conn->query("

					SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
					SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
					SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

					-- -----------------------------------------------------
					-- Schema mydb
					-- -----------------------------------------------------
					-- -----------------------------------------------------
					-- Schema MeetingPuppies
					-- -----------------------------------------------------

					-- -----------------------------------------------------
					-- Schema MeetingPuppies
					-- -----------------------------------------------------
					CREATE SCHEMA IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET latin1 ;
					USE `{$dbname}` ;

					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Chat`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Chat` (
					  `ChatId` INT(11) NOT NULL AUTO_INCREMENT,
					  `User1` INT(11) NOT NULL,
					  `User2` INT(11) NOT NULL,
					  `LastMessage` MEDIUMTEXT NOT NULL,
					  `LastMessageUserId` INT(11) NOT NULL,
					  `LastMessageTimeSent` DATETIME NULL DEFAULT NULL,
					  `MessageSeen` INT(2) NULL DEFAULT NULL,
					  PRIMARY KEY (`ChatId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 20
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Comments`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Comments` (
					  `CommentId` INT(11) NOT NULL AUTO_INCREMENT,
					  `CommentContent` VARCHAR(500) NOT NULL,
					  `Userid` INT(11) NOT NULL,
					  `PostID` INT(11) NOT NULL,
					  `DateOfCreation` DATETIME NULL DEFAULT NULL,
					  PRIMARY KEY (`CommentId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 37
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`FriendRequest`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`FriendRequest` (
					  `FriendRequestId` INT(11) NOT NULL AUTO_INCREMENT,
					  `Sender` INT(11) NOT NULL,
					  `Reciever` INT(11) NOT NULL,
					  PRIMARY KEY (`FriendRequestId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Friendship`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Friendship` (
					  `FriendshipId` INT(11) NOT NULL AUTO_INCREMENT,
					  `User1` INT(11) NOT NULL,
					  `User2` INT(11) NOT NULL,
					  PRIMARY KEY (`FriendshipId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 36
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Groups`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Groups` (
					  `GroupId` INT(11) NOT NULL AUTO_INCREMENT,
					  `GroupName` VARCHAR(125) NOT NULL,
					  `GroupDescription` VARCHAR(2000) NOT NULL,
					  `GroupPicture` VARCHAR(500) NOT NULL,
					  `GroupAdmin` INT(11) NOT NULL,
					  PRIMARY KEY (`GroupId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;

					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`GroupMembers`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GroupMembers` (
					  `GroupMemberId` INT(11) NOT NULL AUTO_INCREMENT,
					  `GroupUserId` INT(11) NOT NULL,
					  `GroupId` INT(11) NOT NULL,
					  PRIMARY KEY (`GroupMemberId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;

					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`GroupRequest`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GroupRequest` (
					  `GroupRequestId` INT(11) NOT NULL AUTO_INCREMENT,
					  `GroupRequestUserId` INT(11) NOT NULL,
					  `GroupRequestGroupId` INT(11) NOT NULL,
					  PRIMARY KEY (`GroupRequestId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;

					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`GroupPosts`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GroupPosts` (
					  `GroupPostId` INT(11) NOT NULL AUTO_INCREMENT,
					  `GroupPostContent` VARCHAR(2048) NOT NULL,
					  `GroupPostUserId` INT(11) NOT NULL,
					  `GroupID` INT(11) NOT NULL,
					  `GroupPostPhoto` VARCHAR(1024) NULL DEFAULT NULL,
					  `DateCreated` DATETIME NULL DEFAULT NULL,
					  PRIMARY KEY (`GroupPostId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;



					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`GroupLikes`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GroupLikes` (
					  `GroupLikeId` INT(11) NOT NULL AUTO_INCREMENT,
					  `GroupPostId` INT(11) NOT NULL,
					  `LikeUserId` INT(11) NOT NULL,
					  PRIMARY KEY (`GroupRequestId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`GroupComments`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GroupComments` (
					  `GroupCommentId` INT(11) NOT NULL AUTO_INCREMENT,
					  `GroupCommentsContent` VARCHAR(500) NOT NULL,
					  `CommentUserId` INT(11) NOT NULL,
					  `GroupPostID` INT(11) NOT NULL,
					  `DateOfCreation` DATETIME NULL DEFAULT NULL,
					  PRIMARY KEY (`GroupCommentId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 2
					DEFAULT CHARACTER SET = latin1;

					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Permissions`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Permissions` (
					  `PermissionKey` VARCHAR(255) NOT NULL,
					  `PermissionDescription` VARCHAR(2048) NULL DEFAULT NULL,
					  PRIMARY KEY (`PermissionKey`))
					ENGINE = InnoDB
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`GroupPermissions`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GroupPermissions` (
					  `GroupId` INT(11) NOT NULL,
					  `PermissionKey` VARCHAR(255) NOT NULL,
					  PRIMARY KEY (`GroupId`, `PermissionKey`),
					  INDEX `fk_Groups_has_Permissions_Permissions1_idx` (`PermissionKey` ASC),
					  INDEX `fk_Groups_has_Permissions_Groups1_idx` (`GroupId` ASC),
					  CONSTRAINT `fk_Groups_has_Permissions_Groups1`
					    FOREIGN KEY (`GroupId`)
					    REFERENCES `{$dbname}`.`Groups` (`GroupId`)
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION,
					  CONSTRAINT `fk_Groups_has_Permissions_Permissions1`
					    FOREIGN KEY (`PermissionKey`)
					    REFERENCES `{$dbname}`.`Permissions` (`PermissionKey`)
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION)
					ENGINE = InnoDB
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Likes`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Likes` (
					  `LikeId` INT(11) NOT NULL AUTO_INCREMENT,
					  `PostID` INT(11) NOT NULL,
					  `UserLikeId` INT(11) NOT NULL,
					  PRIMARY KEY (`LikeId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 59
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Messages`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Messages` (
					  `MessageId` INT(11) NOT NULL AUTO_INCREMENT,
					  `SenderId` INT(11) NOT NULL,
					  `RecieverId` INT(11) NOT NULL,
					  `MessageContent` MEDIUMTEXT NOT NULL,
					  `TimeSent` DATETIME NULL DEFAULT NULL,
					  PRIMARY KEY (`MessageId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 97
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Notifications`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Notifications` (
					  `NotificationId` INT(11) NOT NULL AUTO_INCREMENT,
					  `NotPostId` INT(11) NULL DEFAULT NULL,
					  `NotificationMessage` VARCHAR(125) NOT NULL,
					  `NotUserId` INT(11) NOT NULL,
					  `NotUser1Id` INT(11) NOT NULL,
					  `DateCreated` DATETIME NULL DEFAULT NULL,
					  `CommentId` INT(11) NULL DEFAULT NULL,
					  PRIMARY KEY (`NotificationId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 39
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`PetImages`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`PetImages` (
					  `PetImagesId` INT(11) NOT NULL AUTO_INCREMENT,
					  `PetImage` VARCHAR(1000) NOT NULL,
					  `PetId` INT(11) NOT NULL,
					  `PetOwnerId` INT(11) NOT NULL,
					  PRIMARY KEY (`PetImagesId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 7
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Pets`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Pets` (
					  `PetsId` INT(11) NOT NULL AUTO_INCREMENT,
					  `PetsName` VARCHAR(1000) NULL DEFAULT NULL,
					  `BirthDate` DATE NULL DEFAULT NULL,
					  `Gender` ENUM('M', 'F') NULL DEFAULT NULL,
					  `ProfilePicture` VARCHAR(1000) NULL DEFAULT NULL,
					  `DateCreate` DATE NULL DEFAULT NULL,
					  `Race` VARCHAR(260) NULL DEFAULT NULL,
					  `Chipped` INT(11) NULL DEFAULT NULL,
					  `Vaccinated` INT(11) NULL DEFAULT NULL,
					  `Rate` INT(2) NULL DEFAULT NULL,
					  `Tournament` INT(11) NULL DEFAULT NULL,
					  `About` VARCHAR(2000) NULL DEFAULT NULL,
					  `TypeOfSale` ENUM('Sale', 'Breeding') NULL DEFAULT NULL,
					  `UserId` INT(11) NULL DEFAULT NULL,
					  PRIMARY KEY (`PetsId`),
					  INDEX `UserId` (`UserId` ASC))
					ENGINE = InnoDB
					AUTO_INCREMENT = 31
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Posts`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Posts` (
					  `PostsId` INT(11) NOT NULL AUTO_INCREMENT,
					  `PostContent` VARCHAR(2048) NOT NULL,
					  `PostPhoto` VARCHAR(1024) NULL DEFAULT NULL,
					  `DateCreated` DATETIME NULL DEFAULT NULL,
					  `UserID` INT(11) NOT NULL,
					  PRIMARY KEY (`PostsId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 26
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`Users`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`Users` (
					  `UserId` INT(11) NOT NULL AUTO_INCREMENT,
					  `RealName` VARCHAR(1000) NULL DEFAULT NULL,
					  `Mail` VARCHAR(260) NULL DEFAULT NULL,
					  `PasswordUser` VARCHAR(260) NULL DEFAULT NULL,
					  `BirthDate` DATE NULL DEFAULT NULL,
					  `Gender` ENUM('M', 'F') NULL DEFAULT NULL,
					  `ProfilePicture` VARCHAR(1000) NULL DEFAULT NULL,
					  `City` VARCHAR(260) NULL DEFAULT NULL,
					  `Country` VARCHAR(260) NULL DEFAULT NULL,
					  `DateCreate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
					  PRIMARY KEY (`UserId`))
					ENGINE = InnoDB
					AUTO_INCREMENT = 57
					DEFAULT CHARACTER SET = latin1;


					-- -----------------------------------------------------
					-- Table `MeetingPuppies`.`UserGroups`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`UserGroups` (
					  `UserId` INT(11) NOT NULL,
					  `GroupId` INT(11) NOT NULL,
					  PRIMARY KEY (`UserId`, `GroupId`),
					  INDEX `fk_User_has_Groups_Groups1_idx` (`GroupId` ASC),
					  INDEX `fk_User_has_Groups_User1_idx` (`UserId` ASC),
					  CONSTRAINT `fk_User_has_Groups_Groups1`
					    FOREIGN KEY (`GroupId`)
					    REFERENCES `{$dbname}`.`Groups` (`GroupId`)
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION,
					  CONSTRAINT `fk_User_has_Groups_User1`
					    FOREIGN KEY (`UserId`)
					    REFERENCES `{$dbname}`.`Users` (`UserId`)
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION)
					ENGINE = InnoDB
					DEFAULT CHARACTER SET = latin1;

					USE `{$dbname}` ;

					-- -----------------------------------------------------
					-- Placeholder table for view `MeetingPuppies`.`GET_COMMENTS`
					-- -----------------------------------------------------
					CREATE TABLE IF NOT EXISTS `{$dbname}`.`GET_COMMENTS` (`CommentId` INT, `CommentContent` INT, `Userid` INT, `PostID` INT, `DateOfCreation` INT, `PostsId` INT, `UserComment` INT, `RealName` INT, `ProfilePicture` INT);

					-- -----------------------------------------------------
					-- procedure get_friends
					-- -----------------------------------------------------

					DELIMITER $$
					USE `{$dbname}`$$
					CREATE PROCEDURE `get_friends`(IN USER_ID INT)
					BEGIN
						SELECT Users.RealName,Users.UserId, Users.ProfilePicture
						FROM Friendship  JOIN Users ON Users.UserId = IF(User1 = USER_ID ,User2, User1) 
						WHERE User1 = USER_ID OR User2 = USER_ID;
					END$$

					DELIMITER ;

					-- -----------------------------------------------------
					-- View `{$dbname}`.`GET_COMMENTS`
					-- -----------------------------------------------------
					DROP TABLE IF EXISTS `{$dbname}`.`GET_COMMENTS`;
					USE `{$dbname}`;
					CREATE  VIEW `{$dbname}`.`GET_COMMENTS` AS select `{$dbname}`.`Comments`.`CommentId` AS `CommentId`,`{$dbname}`.`Comments`.`CommentContent` AS `CommentContent`,`{$dbname}`.`Comments`.`Userid` AS `Userid`,`{$dbname}`.`Comments`.`PostID` AS `PostID`,`{$dbname}`.`Comments`.`DateOfCreation` AS `DateOfCreation`,`{$dbname}`.`Posts`.`PostsId` AS `PostsId`,`{$dbname}`.`Users`.`UserId` AS `UserComment`,`{$dbname}`.`Users`.`RealName` AS `RealName`,`{$dbname}`.`Users`.`ProfilePicture` AS `ProfilePicture` from ((`{$dbname}`.`Comments` join `{$dbname}`.`Users` on((`{$dbname}`.`Comments`.`Userid` = `{$dbname}`.`Users`.`UserId`))) join `{$dbname}`.`Posts` on((`{$dbname}`.`Comments`.`PostID` = `{$dbname}`.`Posts`.`PostsId`)));

					SET SQL_MODE=@OLD_SQL_MODE;
					SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
					SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
					");
					if($query){
						$configfile = fopen('MeetPuppies/config.php', "w");
						
						$txt = "<?php ";
						fwrite($configfile,$txt);
						
						$txt = "define(\"DB_HOST\",'{$dbhost}');";
						fwrite($configfile,$txt);
						
						$txt = "define(\"DB_USERNAME\",'{$dbusername}');";
						fwrite($configfile,$txt);
						
						$txt = "define(\"DB_PASSWORD\",'{$dbpassword}');";
						fwrite($configfile,$txt);
						
						$txt = "define(\"DB_DATABASE\",'{$dbname}');";
						fwrite($configfile,$txt);
						
						$txt = "define(\"UPLOAD_PATH\",'{$datapath}/MeetPuppiesImages/');";
						fwrite($configfile,$txt);
						fclose($configfile);

						copy('images/slika.jpg', "{$datapath}/MeetPuppiesImages/slika.jpg");
						copy('images/puppies.png', "{$datapath}/MeetPuppiesImages/puppies.png");

						if(file_exists("MeetPuppies/config.php")){
							header("location:MeetPuppies/index.php");
						}else{
							header("location:index.php");
						}

					}else{
						echo "nece";
					}
			}else{
				echo 'Putanja do foldera <b>' . $datapath . '</b>, ne postoji';
			}
		}
	}

	?>
	<br>
	<a href="index.php">Go back to installation wizard form.</a>