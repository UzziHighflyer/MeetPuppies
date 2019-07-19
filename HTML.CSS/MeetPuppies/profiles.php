<?php 
    require 'function/session.php';
    require 'function/sqlfunctions.php';


    if($user->getId() == $_GET['id']){
        header('location:profil.php');
    }else{
        require 'function/otheruserprofile.php';

    }

    if($_GET['id'] && $_GET['redirect'] == 1){
        $messageuserid = $_GET['id'];
    }


      
?><!DOCTYPE html>
<html>
    <title>Meet Puppies | <?=$user1->getFullname()?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="w3-style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=u5yx1bhgjqzce2w51xfec40m6ftt7z2rg5fgvdkjinhmguxp"></script>
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="javascript/toggleprofile.js"></script>
    
    

   
<body class="w3-theme-l5" onload="return messageUser(<?=$messageuserid?>)">

<!-- Navbar -->
    <?php require 'includes/header.php'; ?>



<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
    <div class="w3-row">
    <!-- Left Column -->
        <div class="w3-col m3">
      <!-- Profile -->
        <div class="w3-card w3-round w3-white">
            <div class="w3-container">
                <h3 class="w3-center"><a href="#"><?=$user1->getFullname()?></a></h3>
                <p class="w3-center"><img src="image.php?img=<?=$user1->getProfilepicture()?>"  class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                <p id="userid" class="w3-hide"><?=$user->getId()?></p>
                <?php 
                    $friends    = checkIfRequestSent($user->getId(),$user1->getId());
                    $friends1   = checkIfFriends($user->getId(),$user1->getId());

                    if(empty($friends)){
                    
                        if(empty($friends1)){
                    ?>  
                            <form action="function/friendrequest.php" method="post">
                                <input type="hidden" name="sender" value="<?=$user->getId()?>">
                                <input type="hidden" name="reciever" value="<?=$user1->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">   
                                <button class="button w3-hover-grey w3-bold" name="addfriend"><i class="fas fa-user-plus"></i> Add Friend</button>
                            </form>    
                    <?php 
                        }else{
                        ?>
                            <form onsubmit="return confirm('Are you sure you want to unfriend <?=$user1->getFullname()?>')" action="function/friendrequest.php" method="post">
                                <input type="hidden" name="sender" value="<?=$user->getId()?>">
                                <input type="hidden" name="reciever" value="<?=$user1->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">   
                                <button class="button w3-green w3-hover-grey w3-bold" name="unfriend"><i class="fas fa-check"></i> You are friends</button>
                            </form>  
                        <?php
                        }
                    } else {
                   
                    ?>  
                        <form action="function/friendrequest.php" method="post">
                            <input type="hidden" name="sender" value="<?=$user->getId()?>">
                            <input type="hidden" name="reciever" value="<?=$user1->getId()?>">
                            <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>"> 
                            <button class="button w3-teget w3-bold" name="cancelrequest">Friend Request Sent</button>
                        </form>
                    <?php
                }
                
                ?>
                <button class="button w3-hover-grey w3-bold" onclick="return messageUser(<?=$user1->getId()?>)"><i class="w3-xlarge far fa-envelope"></i> Send a message</button>
                    <div id="id<?=$user1->getId()?>" onclick="updateChat()" class="w3-modal">
                        <div class="w3-modal-content w3-animate-top w3-card-4" style="overflow:auto;height:600px">
                            <header class="w3-container w3-nasapink"> 
                                <span onclick="document.getElementById('id<?=$user1->getId()?>').style.display='none'" 
                                class="w3-button w3-display-topright">&times;</span>
                                <h2>Chat with <?=$user1->getFullname()?></h2>

                        
                            </header>
                            <div class="w3-container" id="messagecontainer">
                                <p class="w3-large"><i class="fas fa-circle-notch fa-spin"></i> Loading</p>

                            </div>
                            <div class="w3-container w3-nasapink w3-padding" >
                                <form method="post" action="function/messages.php" id="sendMessageForm" class="w3-form">
                                    <textarea name="messagecontent" id="textarea" placeholder="Write a message.."></textarea>
                                    <input type="hidden" name="sender" id="sender" value="<?=$user->getId()?>">
                                    <input type="hidden" name="reciever" id ="reciever" value="<?=$user1->getId()?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <button class="w3-button w3-margin w3-teget w3-bold" name="sendmessage">Send</button>
                                </form>    
                            </div>
                        </div>
                    </div>

                 <hr>
                <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?=$user1->getCity()?> , <?=$user1->getCountry()?></p>
                <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?=$user1->getBirthdate();?></p>
                <p><i class="fas fa-calendar-alt fa-fw w3-margin-right w3-text-theme"></i>Joined: <?=$user1->getDatecreated()?></p>
            </div>
        </div>
        <br>  
      
      <!-- Accordion -->
        <div class="w3-card w3-round">
            <div class="w3-white">
                    <button onclick="sideMenuToggle('Demo1')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> <?=$user1->getFullname()?>'s Groups</button>
                    
                    <div id="Demo1" class="w3-hide w3-container w3-padding" style="text-align: center">
                        <?php
                            $usergroups = getUserGroups($user1->getId());
                            if(!empty($usergroups)){
                                for ($g=0; $g < count($usergroups) ; $g++) { 
                        ?>
                                    <img style="width:60px;height: 60px" src="image.php?img=<?=$usergroups[$g]->GroupPicture?>"><p class="w3-center w3-bold"><a href="group.php?id=<?=$usergroups[$g]->GroupId?>"><?=$usergroups[$g]->GroupName?> <?=($usergroups[$g]->GroupAdmin == $user->getId())?'(Admin)':''?></a></p>
                        <?php 
                                }
                            }else{
                                echo"<p class='w3-center'>{$user1->getFullname()} is member of no groups.</p>";
                            }
                        ?>            
                            

                    </div>
                <button onclick="sideMenuToggle('Demo3')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> <?=$user1->getFullname()?>'s Photos of Pets</button>
                <div id="Demo3" class="w3-hide w3-container">
                    <div class="w3-row-padding">
                        <br>
                        <?php 
                            $petImages = getPetsImages($user1->getId());
                            if(!empty($petImages)){
                                for ($pi=0; $pi < count($petImages); $pi++) { 
                                    
                                
                        ?>
                                    <div class="w3-half">
                                        <p class="w3-bold"><?=$petImages[$pi]->PetsName?></p>
                                        <img src="image.php?img=<?=$petImages[$pi]->PetImage?>" style="width:100%" class="w3-margin-bottom">
                                    </div>

                        <?php 
                                }
                            }else{
                                ?>
                                    <p class="w3-center"><?=$user1->getFullname()?> has no pets.</p>

                                <?php
                            }
                        ?>
                    </div>
                </div>
                <button onclick="sideMenuToggle('Demo4')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> <?=$user1->getFullname()?>'s Friends</button>
                <div id="Demo4" class="w3-hide w3-container">
                    <?php 
                    
                        $red  = getUserFriends($user1->getId());
                        if(!empty($red)){
                            for ($f=0; $f < count($red); $f++) { 
                    ?>
                            <p class="w3-left w3-block"><img style="width:50px" src="image.php?img=<?=$red[$f]->ProfilePicture?>"><a href="profiles.php?id=<?=$red[$f]->UserId?>"><?=$red[$f]->RealName?></a></p>
                    
                    <?php 
                            }
                        }else{
                           ?> <p class="w3-left w3-block"><?=$user1->getFullname()?> has no friends yet :( </p>
                    <?php
                        }
                     ?>
                </div>
            </div>      
        </div>
        <br>

        <ul class="w3-ul w3-card-4 w3-hoverable">
            <li class="w3-bar">
                <h3 class="w3-center"><a href="#"> Pets</a></h3>
                
            </li>
            <?php  
                $pets = getUserPets($user1->getId());

                if(!empty($pets)){
                   for($i=0;$i <count($pets);$i++){ 
            ?>
                    <li class="w3-bar">
                        <span onclick="petsToggle('Pet<?=$i?>')" class="w3-bar-item w3-button  w3-xlarge w3-right"><i class="fas fa-angle-down"></i></span>
                        <img src="image.php?img=<?=$pets[$i]->ProfilePicture?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px; height:65px">
                        <div class="w3-bar-item">
                            <a style="cursor:pointer" onclick="return showPetInfo('<?=$pets[$i]->PetsId?>');"><span class="w3-large w3-bold"><?=$pets[$i]->PetsName?></span></a><br>
                            <span><?=$pets[$i]->Race?></span>
                        </div>
                            <p id="Pet<?=$i?>" class="w3-hide w3-container"> <?=$pets[$i]->About?></p>

                    </li> 

                    <div id="id<?=$pets[$i]->PetsId?>" class="w3-modal">
                        <div class="w3-modal-content w3-animate-top w3-card-4">
                            <header class="w3-container w3-nasapink"> 
                                <span onclick="document.getElementById('id<?=$pets[$i]->PetsId?>').style.display='none'" 
                                class="w3-button w3-display-topright">&times;</span>
                                <h2><?=$pets[$i]->PetsName?></h2>

                        
                            </header>
                            <div class="w3-container">
                                <img src="image.php?img=<?=$pets[$i]->ProfilePicture?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px; height:65px">
                                <h3><?=$pets[$i]->Race?></h3>
                                <p>Date of birth:<b><?=$pets[$i]->BirthDate?></b></p>
                                <p>Gender:<b><?=$pets[$i]->Gender?></b></p>
                                <p>Chipped:<b> <?= ($pets[$i]->Chipped = 1)?'Yes':'No' ?></b></p>
                                <p>Vaccinated:<b> <?= ($pets[$i]->Vaccinated = 1)?'Yes':'No' ?></b></p>
                                <p>Ever been to exhibition of dogs:<b> <?= ($pets[$i]->Tournament = 1)?'Yes':'No' ?></b></p>
                                <p>Rate:<b><?=$pets[$i]->Rate?></b></p>
                                <p>Type of registration:<b><?=$pets[$i]->TypeOfSale?></b></p>
                                <p>About:<b><?=$pets[$i]->About?></b></p>

                                 <?php  
                                    $onePetImages = getPetImages($pets[$i]->PetsId);
                                    if(!empty($onePetImages)){
                                        for ($z=0; $z < count($onePetImages) ; $z++) { 
                                            ?>
                                                <img class="w3-third w3-margin" style="height: 220px" src="image.php?img=<?=$onePetImages[$z]->PetImage?>">
                                            <?php      
                                        }

                                    }
                                ?>
                                 
                            
                            </div>
                            
                        </div>
                    </div>
            <?php
                    }
                }else{
            ?>
                        <li class="w3-bar">
                           <p><?=$user1->getFullname()?> has no pets.</p>
                        </li>

                    <?php
                }

            ?>

        </ul>

	

  
        <!-- Alert Box -->
        <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
                <i class="fa fa-remove"></i>
            </span>
            <p><strong>Hey!</strong></p>
            <p>People are looking at your profile. Find out who.</p>
        </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">

        <div id="mainProfile">
            
        
            <?php

                
                $posts = getUserPosts($user1->getId());
            if(!empty($friends1)){
                if(!empty($posts)) {
                    for($j=0;$j < count($posts);$j++){
                        ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin  w3-margin-bottom-50" id="mainProfile"><br>
                            <img src="image.php?img=<?=$user1->getProfilepicture()?>" alt="<?=$user->getFullname()?>" class="w3-left w3-circle w3-margin-right" style="width:60px">
                            <span class="w3-right w3-opacity">Posted on: <?=$posts[$j]->DateCreated?></span>
                            <h4><?=$user1->getFullname()?></h4><br>
                            <p class="w3-large w3-wordwrap"><?=$posts[$j]->PostContent?></p>

                            <?php 
                                $lajkovi = getPostLikeNumber($posts[$j]->PostsId);
                                $komentari = getPostCommentNumber($posts[$j]->PostsId);

                                if(!empty($lajkovi)){
                                    ?> <a style="cursor:pointer" onclick="return showLikes(<?=$posts[$j]->PostsId?>);"><i class='w3-text-teget fa fa-thumbs-up'></i><?=count($lajkovi)?></a>
                                <?php
                                }else{
                                    echo "<i class='w3-text-teget fa fa-thumbs-up'></i> 0";
                                }
                                
                                if(!empty($komentari)){
                                    echo " <i class='w3-text-nasapink fa fa-comment'></i> " . count ($komentari);
                                }else{
                                    echo " <i class='w3-text-nasapink fa fa-comment'></i> 0";
                                }
                            ?>
                            
                            <!-- <div class="w3-row-padding" style="margin:0 -16px">
                                <div class="w3-half">
                                    <img src="/w3images/lights.jpg" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
                                </div>
                                <div class="w3-half">
                                    <img src="/w3images/nature.jpg" style="width:100%" alt="Nature" class="w3-margin-bottom">
                                </div>
                            </div> -->
                            <?php 
                            $likesrow = checkIfUserLiked($user->getId(),$posts[$j]->PostsId);
                            if(empty($likesrow)){
                        ?>
                                <form method="post" action="function/likes.php">    
                                    <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                    <input type="hidden" name="userliked" value="<?=$user1->getId()?>"> 
                                    <button type="submit" name="likepost" class="w3-button w3-theme-nasa w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
                                </form>
                            
                            <?php 
                            }else{
                        ?>    
                                <form method="post" action="function/likes.php">    
                                    <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                    <input type="hidden" name="userliked" value="<?=$user1->getId()?>">
                                    <input type="hidden" name="likeid" value="<?=$likesrow[0]->LikeId?>">
                                    <button type="submit" name="unlikepost" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-check"></i>  Liked</button> 
                                </form>
                            <?php   
                            }
                           
                            ?>
                            <button onclick ="commentToggle('Comment<?=$j?>')" type="button" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>
                           
                            <button class="w3-theme-nasa4" onclick="commentSectionToggle('CommentSection<?=$j?>')">Show all <span id="numberOfComments"><?=count($komentari)?></span> Comments</button>
                            <div id="CommentSection<?=$j?>" class="w3-hide w3-container">
                                <div id="commentcounter<?=$j?>">
                                <?php
                                    $comments = getPostComments($posts[$j]->PostsId);

                                    if(!empty($comments)){
                                        for($k=0;$k <count($comments);$k++){
                                            ?>
                                            
                                                <div class="w3-container w3-card w3-white w3-round w3-margin-bottom w3-padding">
                                                    <img src="image.php?img=<?=$comments[$k]->ProfilePicture?>" alt="<?=$comments[$k]->RealName?>" class="w3-left w3-circle w3-margin-right" style="width:50px;height:50px">
                                                    <span class="w3-right w3-opacity">Posted on: <?=$comments[$k]->DateOfCreation?></span>
                                                     <?php 
                                                    if($user->getId() == $comments[$k]->Userid){
                                                        ?>
                                                        <form onsubmit="return confirm('Are you sure you want to delete this comment?');" method="post" action="function/deletecomments.php" id="deleteCommentForm">
                                                            <input type="hidden" name="commentid" value="<?=$comments[$k]->CommentId?>">
                                                            <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                                            <input type="hidden" name="usercomment" value="<?=$user->getId()?>">
                                                            <input type="hidden" name="usercommented" value="<?=$user1->getId()?>">
                                                            <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>"> 
                                                            <button name="deletecomment" class="w3-right w3-text-black w3-hover-text-grey w3-white w3-border-0"><i class="fas fa-times"></i></button>
                                                        </form>
                                                    <?php
                                                    } ?>
                                                    <h4><?=$comments[$k]->RealName?></h4><br>
                                                    <p class="w3-large w3-wordwrap"><?=$comments[$k]->CommentContent?></p>
                                                </div>
                                        <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div> 
                                
                        </div>
                            <div id="Comment<?=$j?>" class="w3-hide w3-container  w3-margin-bottom-32">
                            <form action="function/addcomments.php" method="post">
                                <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                <input type="hidden" name="usercomment" value="<?=$user->getId()?>">
                                <input type="hidden" name="usercommented" value="<?=$user1->getId()?>"> 
                                <input id="commentText<?=$j?>" class="w3-input w3-large" name="postcomment" type="text" placeholder="Any Comment?" required>
                                <input id="commentButton<?=$j?>" class="w3-button w3-theme-nasa1 w3-margin-bottom w3-bold" name="commentbutton" type="submit" value="Comment" required>
                            </form> 
                        </div> 

                        <div id="pid<?=$posts[$j]->PostsId?>" class="w3-modal">
                        <div class="w3-modal-content w3-animate-top w3-card-4">
                            <header class="w3-container w3-nasapink"> 
                                <span onclick="document.getElementById('pid<?=$posts[$j]->PostsId?>').style.display='none'" 
                                class="w3-button w3-display-topright">&times;</span>
                                <h2>Likes</h2>
                            
                        
                            </header>
                            
                                <?php 
                                    $row = getPostLikeUsers($posts[$j]->PostsId);
                                    if(!empty($row)){
                                        for($r=0;$r < count($row);$r++){
                                ?>          <div class="w3-container w3-padding">
                                            <img src="image.php?img=<?=$row[$r]->ProfilePicture?>" class="w3-bar-item w3-circle w3-hide-small" style="width:65px; height:65px">
                                            <a href="profiles.php?id=<?=$row[$r]->UserId?>"><?=$row[$r]->RealName?></a>
                                            </div>
                                <?php   }
                                    } 
                                ?>
                            
                            
                        </div>
                    </div> 
                <?php
                    }
                }else{
                    echo '<p class="w3-center w3-xxlarge">No posts yet.</p>';
                }
            }else{
                echo "<p class='w3-center w3-xxlarge'>You cannot see {$user1->getFullname()}'s posts. You are not friends.</p>";
            }

                ?>
            </div>
        <!-- Add a pet -->

        
      
        
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->





    <!--<div class="w3-col m2">
        <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
                <p>Upcoming Events:</p>
                <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
                <p><strong>Holiday</strong></p>
                <p>Friday 15:00</p>
                <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
            </div>
        </div>
        <br>
      
        <div class="w3-card w3-round w3-white w3-center">
            <div class="w3-container">
                    <p>Friend Request</p>
                    <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
                    <span>Jane Doe</span>
                <div class="w3-row w3-opacity">
                    <div class="w3-half">
                        <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
                    </div>
                    <div class="w3-half">
                        <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
            </div>
        </div>
      <br>
      
        <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
             <p>ADS</p>
        </div>
        <br>
      
        <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
            <p><i class="fa fa-bug w3-xxlarge"></i></p>
        </div>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Page Container -->
    </div>
  

<br>

<!-- Footer -->

    <footer class="w3-container w3-theme-nasa3">
        <p>Powered by &lt;Uzzi&gt; & &lt;Anci&gt; </p>
    </footer>
 
    <script src="javascript/functions.js"></script>

</body>
</html> 
