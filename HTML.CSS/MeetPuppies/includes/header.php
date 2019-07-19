    <script src="javascript/getchat.js"></script>    
    <script src="javascript/passwordverify.js"></script>
    <script src="javascript/togglesettings.js"></script>
    <script src="javascript/functions.js"></script>
    <script src="javascript/getmessages.js"></script>
    <script src="javascript/sendmessage.js"></script>
    <script src="javascript/likes.js"></script>
    

    <?php 
        $directoryPath = $_SERVER['REQUEST_URI'];
        $directoryPath = explode('/',$directoryPath);
        unset($directoryPath[count($directoryPath)-1]);
        $directoryPath = implode('/',$directoryPath);
      
    ?>

    <div class="w3-top">
        <div class="w3-bar w3-theme-nasa w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button w3-padding-large w3-theme-nasa w3-hover-white"><i class="fa fa-home w3-margin-right"></i><b>Meet<i class="fa fa-paw"></i>Puppies</b></a>
            

                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-button w3-padding-large w3-hover-white" onclick="resetNotifications(z,'numberoffriendrequest)" title="Friend Requests"><i class="fa fa-user"></i><span id="numberoffriendrequest" class="w3-badge w3-right w3-small w3-svetloljubicasta"></span></button>     
                    <div id="friendrequestlist" class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                        <?php 
                            $friendrequest = getFriendRequests($user->getId());
                            if(!empty($friendrequest)){
                                for($f=0;$f < count($friendrequest);$f++){
                        ?>

                                    <a href="#" class="w3-bar-item w3-button"> <img src="image.php?img=<?=$friendrequest[$f]->ProfilePicture?>" alt="Avatar" style="border-radius:50%;width:50px"><?=$friendrequest[$f]->RealName?> sent you a friend request
                                        <div class="w3-half">
                                            <form action="function/friendrequest.php" method="post" style="display:inline !important">
                                                <input type="hidden" name="sender" value="<?=$friendrequest[$f]->Sender?>">
                                                <input type="hidden" name="reciever" value="<?=$friendrequest[$f]->Reciever?>">
                                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                                <button class="w3-button w3-block w3-green w3-section" name="acceptrequest" title="Accept"><i class="fa fa-check"></i></button>
                                            </form>
                                        </div>
                                        <div class="w3-half">
                                            <form action="function/friendrequest.php" method="post"  style="display:inline !important">
                                                <input type="hidden" name="sender" value="<?=$friendrequest[$f]->Sender?>">
                                                <input type="hidden" name="reciever" value="<?=$friendrequest[$f]->Reciever?>">
                                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                                <button class="w3-button w3-block w3-red w3-section" name="declinerequest" title="Decline"><i class="fa fa-remove"></i></button>
                                            </form>
                                        </div>

                                    </a>
                        <?php 
                            }
                        }
                         ?>
                                
                            
                    </div>
                </div>
        

                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-button w3-padding-large w3-hover-white" onclick="resetNotifications(z,'numberofmessages')"  title="Messages"><i class="fa fa-envelope"></i><span id="numberofmessages" class="w3-badge w3-right w3-small w3-svetloljubicasta"></span></button>     
                    <div id="messagelist" class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                    <?php
                        $chats = getChats($user->getId());

                        if(!empty($chats)){
                            for ($c=0; $c < count($chats); $c++) { 
                                $checkIfSeen = getChatsCheckIfSeen($user->getId(),$chats[$c]->UserId);
                                $checkIfIHaveSeen = getChatsCheckIfSeen($chats[$c]->UserId,$user->getId());
                                ?>
                                    <a onclick="return redirectProfile(<?=$chats[$c]->UserId?>,'<?=$directoryPath?>')" class=" w3-bar-item w3-button <?=($checkIfIHaveSeen[0]->MessageSeen != 1)?'w3-light-grey':''?>"><p><img src="image.php?img=<?=$chats[$c]->ProfilePicture?>" style="width:40px"> <?=$chats[$c]->RealName?></p>
                                        <p class="w3-small">
                                    <?php  
                                        if($chats[$c]->LastMessageUserId == $user->getId()){
                                            if($checkIfSeen[0]->MessageSeen){
                                                ?>
                                                    <i class="fas fa-check-double w3-text-teget"></i>
                                                 
                                                <?php
                                            }else{
                                                ?>
                                                    <i class="fas fa-arrow-right"></i>
                                                <?php
                                            }
                                            
                                        }else{
                                            echo "";
                                        }

                                    ?>

                                        <span class="w3-right"><?=$chats[$c]->LastMessageTimeSent?></span> <?=$chats[$c]->LastMessage?></p></a>
                            <?php
                                if($chats[$c]->MessageSeen){
                                    ?>
                                        <span class="w3-hide w3-seen">bla</span>
                                    <?php
                                }
                            }
                        }

                        ?>

                    </div>
                </div>
                
                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-button w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span id="numberofnotifications" class="w3-badge w3-right w3-small w3-svetloljubicasta"></span></button>     
                    <div id="notificationlist" class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                        <?php 
                            $notification = getNotifications($user->getId());
                            if(!empty($notification)){
                                for($n=0;$n < count($notification);$n++){
                        ?>

                                   
                                    <?php  
                                        if($notification[$n]->NotPostId == null){
                                        ?>    
                                             <a href="profiles.php?id=<?=$notification[$n]->NotUser1Id?>"class="w3-bar-item w3-button"><?=$notification[$n]->NotificationMessage?>
                                        <?php
                                        }else{
                                            ?>
                                            <a href="profil.php?post=<?=$notification[$n]->NotPostId?>"class="w3-bar-item w3-button"><?=$notification[$n]->NotificationMessage?>
                                            <?php
                                        }
                                    ?> 
                                    <br> <small class="w3-bold w3-small"><?=$notification[$n]->DateCreated?></small></a>
                        <?php 
                                }
                            }
                         ?>


                        
                        
                    </div>
                </div>





            <div class="w3-row-padding w3-theme-nasa w3-half w3-container">
                <form method="post" action="search.php">
                    <div class="w3-third w3-bar-item">
                        <input class="w3-input w3-border" name="user" id="searchinput" type="text" placeholder="Search in MeetPuppies" required>                     
                    </div>
                    <div class="w3-quarter w3-bar-item">
                        <input type="submit" name="searchuser" value="Search" class="w3-button w3-theme-nasa1 w3-margin-bottom w3-bold w3-hover-white">
                    </div>
                </form>
             </div>

                <div class=" w3-dropdown-hover w3-hide-small w3-floatleft w3-container">
                  <!--  <button class="w3-button w3-padding-large w3-hover-white" title="Notifications"><i class="fa fa-bell"></i><span id="numberofnotifications" class="w3-badge w3-right w3-small w3-svetloljubicasta"></span></button>  -->
                    <span><img src="image.php?img=<?=$user->getProfilepicture()?>" class="w3-circle" style="height:80px;width:80px;padding:8px" alt="John Doe"></span>
    
                    <div id="notificationlist" class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                        <a href="profil.php" class="w3-bar-item w3-button">My Profile</a>
                        
                        
                        <a onclick="document.getElementById('id02').style.display='block'" class="w3-bar-item w3-button">Settings</a> 
 			            <a href="function/logout.php" class="w3-bar-item w3-button">Logout</a>
                    </div>
                </div>


        </div>
    </div>


            <div id="id02" class="w3-modal">
                <div class="w3-modal-content w3-animate-top w3-card-4">
                    <header class="w3-container w3-nasapink"> 
                        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <h2>Settings</h2>
                	
                    </header>
                        <div class="w3-container w3-padding">
                        	<img src="image.php?img=<?=$user->getProfilepicture()?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px; height:85px">
                    		<h3><?=$user->getFullname()?></h3>
                            <a href="javascript:void(0)" id="editPassword" class="w3-bar-item w3-button">Change password</a>
                    		<a href="javascript:void(0)" id="editName"class="w3-bar-item w3-button">Change name</a>
                            <a href="javascript:void(0)" id="editProfilePicture"class="w3-bar-item w3-button">Change profile picture</a>
                    		<a href="javascript:void(0)" id="help"class="w3-bar-item w3-button">Help&Support</a>

                            <form method="post" class="w3-container w3-card-4 w3-white w3-text-nasapink w3-margin w3-padding" id="editPasswordForm" action="function/settings.php">
                                <h2 class="w3-center w3-text-teget w3-bold">Change Password</h2>
                                <input class="w3-input" type="password" id="oldpassword" name="oldpassword" placeholder="Enter Old Password" required> <br>
                                <input class="w3-input" type="password" id="reoldpassword" name="reoldpassword" placeholder="Reenter Old Password" required> <br>
                                <input class="w3-input" type="password" id="newpassword" name="newpassword" placeholder="New Password" required> <br>
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                <input type="submit" class="w3-button w3-teget w3-hover-nasapink" id="changepasswordDugme" value="Change Password" name="changepassword">
                            </form>

                            <form method="post" class="w3-container w3-card-4 w3-white w3-text-nasapink w3-margin w3-padding " id="editNameForm" action="function/settings.php">
                                <h2 class="w3-center w3-text-teget w3-bold">Change your Name</h2>
                                <input class="w3-input" onkeyup="showNewName(this.value)" type="text" name="newname" placeholder="Enter New Name" required> <br>
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                <input type="submit" class="w3-button w3-teget w3-hover-nasapink" value="Change Name" name="changename">
                            </form>

                            <form method="post" class="w3-container w3-card-4 w3-white w3-text-nasapink w3-margin w3-padding " id="editProfilePictureForm" action="function/settings.php" enctype="multipart/form-data">
                                <label class="w3-bold">Profile picture</label>
                                <input class="w3-input w3-bold" name="profilepicture" type="file" placeholder="Profile picture" required>
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                <input type="submit" class="w3-button w3-teget w3-hover-nasapink" value="Change Profile Picture" name="changeprofilepicture">
                            </form>

                            <p id="NewNameFull" class="w3-text-teget w3-bold w3-large">New Name:<span id="NewName"></span></p>

                            <form method="post" class="w3-container w3-card-4 w3-white w3-text-nasapink w3-margin w3-padding " id="helpForm" >

                    			<h2>Contact us</h2>
                    			<a href="#">office@meetpuppies.com</a>

                            </form>
                    
                        
                        </div>
                    <!-- <footer class="w3-container w3-nasapink">
                        <b>Meet<i class="fa fa-paw"></i>Puppies</b>
                    </footer> -->
                </div>
            </div>









        <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
    </div>
