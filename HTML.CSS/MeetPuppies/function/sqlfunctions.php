<?php 
		function sqlDefaultFunction($query){
            $conn = Konekcija::get();
            $query = $conn->query($query);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }

        function getPostsFriends($userid){
            $conn = Konekcija::get();
	        $upit = $conn->prepare("SELECT Posts.*,Friendship.*, Users.RealName,Users.UserId,Users.ProfilePicture FROM Posts JOIN Users ON Posts.UserID = Users.UserId  JOIN Friendship ON :userid = Friendship.User1 WHERE Friendship.User2 = Users.UserId   ORDER BY DateCreated DESC;");
	        $upit->execute(array(':userid' => $userid));
	        $posts = $upit->fetchAll(PDO::FETCH_OBJ);
	    	return $posts;
	    }


        function getPostLikeNumber($postid){
            return sqlDefaultFunction("SELECT LikeId FROM Likes WHERE Likes.PostID = {$postid}");
        }

        function getPostLikeNumberGroup($postid){
            return sqlDefaultFunction("SELECT * FROM GroupLikes WHERE GroupPostId = {$postid}");
        }
        
        function getPostCommentNumber($postid){
        	return sqlDefaultFunction("SELECT CommentId FROM Comments JOIN Users ON Comments.Userid = Users.UserId JOIN Posts ON Comments.PostID = Posts.PostsId WHERE PostID = {$postid} ");
        }

        function getPostCommentNumberGroup($postid){
            return sqlDefaultFunction("SELECT GroupCommentId FROM GroupComments WHERE GroupPostID = {$postid}");
        }
                                
                      
        function checkIfUserLiked($userid,$postid){
        	$conn = Konekcija::get();
            $querylikes = $conn->prepare("SELECT Posts.*,Likes.* FROM Likes JOIN Posts ON {$postid} = Likes.PostID WHERE UserLikeId = :userid");
 	        $querylikes->execute(array(':userid' => $userid));
            $likesrow  = $querylikes->fetchAll(PDO::FETCH_OBJ);
            return $likesrow;
            
        }

        function checkIfUserlikedGroup($userid,$postid){
            return sqlDefaultFunction("SELECT GroupPosts.* ,GroupLikes.* FROM GroupLikes JOIN GroupPosts ON {$postid} = GroupLikes.GroupPostId WHERE LikeUserId = {$userid}");
        }                
                            
        function getPostComments($postid){
        	return sqlDefaultFunction("SELECT * FROM Comments JOIN Users ON Comments.Userid = Users.UserId JOIN Posts ON Comments.PostID = Posts.PostsId  WHERE PostID = {$postid} ORDER BY DateOfCreation DESC ");
        }

        function getPostCommentsGroup($postid){
            return sqlDefaultFunction("SELECT * FROM GroupComments JOIN Users ON GroupComments.CommentUserId = Users.UserId JOIN GroupPosts ON GroupComments.GroupPostID = GroupPosts.GroupPostId WHERE GroupPosts.GroupPostID = {$postid}");
        }                
                                
        function getPostLikeUsers($postid){
        	return sqlDefaultFunction("SELECT Users.RealName,Users.UserId, Users.ProfilePicture FROM Users JOIN Likes ON Users.UserId = Likes.UserLikeId JOIN Posts ON Posts.PostsId = Likes.PostID WHERE Posts.PostsId = {$postid}");
            
        }

        function getPostLikeUsersGroup($postid){
            return sqlDefaultFunction("SELECT Users.RealName,Users.UserId, Users.ProfilePicture FROM Users JOIN GroupLikes ON Users.UserId = GroupLikes.LikeUserId JOIN GroupPosts ON GroupPosts.GroupPostId = GroupLikes.GroupPostId WHERE GroupPosts.GroupPostId = {$postid}");
            
        }               


        function getUserFriends($userid){
        	return sqlDefaultFunction("SELECT Users.UserId, Users.RealName ,Users.ProfilePicture FROM Users JOIN Friendship ON {$userid} = Friendship.User1 WHERE User2 = UserId;");
        }                 

        function getUserPets($userid){
        	return sqlDefaultFunction("SELECT * FROM Pets WHERE UserId = {$userid}");
        }

        function getUserPosts($userid){
        	return sqlDefaultFunction("SELECT * FROM Posts WHERE UserID = {$userid} ORDER BY DateCreated DESC");
        }

        function getUserPost($userid,$postid){
        	$conn = Konekcija::get();
        	$upit = $conn->prepare("SELECT * FROM Posts WHERE UserID = {$userid} AND PostsId = :postid ORDER BY DateCreated DESC");
            $upit->execute(array(':postid' => $postid));
            $posts = $upit->fetchAll(PDO::FETCH_OBJ);
            return $posts;
        }


        function getFriendRequests($userid){
        	return sqlDefaultFunction("SELECT FriendRequest.* , Users.UserId, Users.RealName, Users.ProfilePicture  FROM FriendRequest JOIN Users ON FriendRequest.Sender = Users.UserId WHERE FriendRequest.Reciever = {$userid}");
        }

        function checkIfRequestSent($user1id,$user2id){
        	return sqlDefaultFunction("SELECT * FROM FriendRequest WHERE Sender = {$user1id} AND Reciever = {$user2id}");
        }

        function checkIfFriends($user1id,$user2id){
        	return sqlDefaultFunction("SELECT * FROM Friendship WHERE (User1 = {$user1id} AND User2 = {$user2id}) OR (User1 = {$user2id} AND User2 = {$user1id})");
        }

        function getUserSearched($user){
        	$conn   = Konekcija::get();
        	$query  = $conn->prepare("SELECT Users.UserId, Users.RealName, Users.ProfilePicture FROM Users WHERE Users.RealName LIKE '%$user%'");
            $query->execute(array(':user'=>$user));
            $row    = $query->fetchAll(PDO::FETCH_OBJ);
            return $row;
        }

        function getGroupSearched($group){
            $conn = Konekcija::get();
            $query = $conn->prepare("SELECT * FROM Groups WHERE Groups.GroupName LIKE '%$group%'");
            $query->execute(array(':group' => $group));
            $row1   = $query->fetchAll(PDO::FETCH_OBJ);
            return $row1;
        }


        function getChats($userid){
			return sqlDefaultFunction("SELECT Chat.*, Users.RealName, Users.UserId,Users.ProfilePicture  FROM Chat JOIN Users ON Users.UserId = IF(Chat.User1 = {$userid},Chat.User2, Chat.User1) WHERE User1 = {$userid} ORDER BY LastMessageTimeSent DESC");     	
        }

        function getChatsCheckIfSeen($userid,$user2id){
            return sqlDefaultFunction("SELECT Chat.MessageSeen,Chat.LastMessageUserId  FROM Chat WHERE User1 = {$user2id} AND User2 = {$userid}");
        }

        function getNotifications($userid){
        	return sqlDefaultFunction("SELECT *  FROM Notifications WHERE NotUserId = {$userid} ORDER BY DateCreated DESC");
        }

        function getPetsImages($userid){
            return sqlDefaultFunction("SELECT Pets.PetsName,Pets.PetsId, PetImages.* FROM Pets JOIN PetImages ON PetImages.PetId = Pets.PetsId WHERE PetOwnerId = {$userid}");
        }

        function getPetsProfilePicture($userid){
            return sqlDefaultFunction("SELECT Pets.PetsName,Pets.ProfilePicture FROM Pets WHERE UserId = {$userid}");
        }

        function getPetImages($petid){
            return sqlDefaultFunction("SELECT * FROM PetImages WHERE  PetId = {$petid}");
        }

        function getPetSuggestions($userid,$petrace){
            return sqlDefaultFunction("SELECT Pets.PetsName,Pets.ProfilePicture,Pets.Race,Pets.TypeOfSale,Pets.About,Users.RealName,Users.UserId FROM Pets JOIN Users ON Pets.UserId = Users.UserId  WHERE Race Like '%{$petrace}%' AND Pets.UserId <> {$userid}");
        }

        function getUserGroups($userid){
            return sqlDefaultFunction("SELECT * FROM Groups JOIN GroupMembers ON Groups.GroupId = GroupMembers.GroupId WHERE GroupUserId = {$userid}");
        }

        function getGroupAdmin($groupid){
            return sqlDefaultFunction("SELECT Users.UserId, Users.ProfilePicture,Users.RealName FROM Users JOIN Groups ON Users.UserId = Groups.GroupAdmin WHERE GroupId = {$groupid}");
        }

        function getGroupMembers($groupid){
            return sqlDefaultFunction("SELECT Users.UserId, Users.ProfilePicture,Users.RealName FROM Users JOIN GroupMembers ON Users.UserId = GroupMembers.GroupUserId WHERE GroupId = {$groupid}");
        }

        function checkIfUserMember($userid,$groupid){
            return sqlDefaultFunction("SELECT * FROM GroupMembers WHERE GroupId = {$groupid} AND GroupUserId = {$userid}");
        }

        function checkIfMemberRequestSent($userid,$groupid){
            return sqlDefaultFunction("SELECT * FROM GroupRequest WHERE GroupRequestGroupId = {$groupid} AND GroupRequestUserId = {$userid}");
        }

        function checkIfAdmin($userid,$groupid){
            return sqlDefaultFunction("SELECT * FROM Groups WHERE GroupId = {$groupid} AND GroupAdmin = {$userid}");
        }

        function getMemberRequests($groupid){
            return sqlDefaultFunction("SELECT Users.UserId, Users.ProfilePicture,Users.RealName FROM Users JOIN GroupRequest ON GroupRequest.GroupRequestUserId = Users.UserId WHERE GroupRequestGroupId = {$groupid} ");
        }

        function getGroupPosts($groupid){
            return sqlDefaultFunction("SELECT Users.UserId, Users.ProfilePicture,Users.RealName, GroupPosts.* FROM GroupPosts JOIN Users ON GroupPosts.GroupPostUserId = Users.UserId WHERE GroupID = {$groupid} ORDER BY DateCreated DESC");
        }