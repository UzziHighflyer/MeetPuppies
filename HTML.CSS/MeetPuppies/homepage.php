<?php  
    require 'function/session.php';
    require 'function/sqlfunctions.php';
   

    
        $directoryPath = $_SERVER['REQUEST_URI'];
        $directoryPath = explode('/',$directoryPath);
        unset($directoryPath[count($directoryPath)-1]);
        $directoryPath = implode('/',$directoryPath);
      


?><!DOCTYPE html>
<html>
    <title>Meet Puppies | Homepage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="w3-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
<body class="w3-theme-l5">

<!-- Navbar -->

    <?php 
        require 'includes/header.php';
    ?>
        



<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
    <div class="w3-row">
    <!-- Left Column -->
        <div class="w3-col m3">
            <div class="w3-card w3-round w3-white w3-margin-bottom">
                <div class="w3-container">
                    <h3 class="w3-center"><a href="profil.php"><?=$user->getFullname()?><small class="w3-small">(this is you)</small></a></h3>

                    <p class="w3-center"><img src="image.php?img=<?=$user->getProfilepicture()?>"  class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                    <p id="userid" class="w3-hide"><?=$user->getId()?></p>
                    
                </div>
            </div>
      
      
      <!-- Accordion -->
        <div class="w3-card w3-round">
            <div class="w3-white">
                    <button onclick="sideMenuToggle('Demo1')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Groups</button>
                    <div id="Demo1" class="w3-hide w3-container w3-padding" style="text-align: center">
                        <?php
                            $usergroups = getUserGroups($user->getId());
                            if(!empty($usergroups)){
                                for ($g=0; $g < count($usergroups) ; $g++) { 
                        ?>
                                    <img style="width:60px;height: 60px" src="image.php?img=<?=$usergroups[$g]->GroupPicture?>"><p class="w3-center w3-bold"><a href="group.php?id=<?=$usergroups[$g]->GroupId?>"><?=$usergroups[$g]->GroupName?> <?=($usergroups[$g]->GroupAdmin == $user->getId())?'(Admin)':''?></a></p>
                        <?php 
                                }
                            }else{
                                echo"<p class='w3-center'>You are member of no groups.</p>";
                            }
                        ?>            
                            <button class="w3-button w3-nasapink w3-bold" onclick="return showGroupForm('groupform')"><i class="fas fa-plus-square"></i> Create Group</button>

                            <div id="groupform" class="w3-modal">
                                <div class="w3-modal-content w3-animate-top w3-card-4">
                                    <header class="w3-container w3-nasapink"> 
                                        <span onclick="document.getElementById('groupform').style.display='none'" 
                                        class="w3-button w3-display-topright">&times;</span>
                                        <h2>Create Croup</h2>
                                    
                                
                                    </header>
                                    <div class="w3-container w3-padding">
                                        <form action="function/group.php" class="w3-padding" method="POST" enctype="multipart/form-data">
                                            <input class="w3-input" type="text" name="groupname" placeholder="Name your group">  <br>
                                            <input class="w3-input" type="text" name="groupdescription" placeholder="Describe your group"> <br>
                                            <input class="w3-input" type="file" name="profilepicture">
                                            <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                            <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                            <input type="submit" class="w3-button w3-block w3-section w3-teget w3-hover-nasapink w3-ripple w3-padding w3-bold" name="creategroup">
                                        </form>
                                    </div>
                                       
                                    
                                    <footer class="w3-container w3-nasapink">
                                        <b>Meet<i class="fa fa-paw"></i>Puppies</b>
                                    </footer>
                                </div>
                            </div> 

                    </div>
                <button onclick="sideMenuToggle('Demo3')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Tournaments</button>
                <div id="Demo3" class="w3-hide w3-container">
                    <p class="w3-center"><a href="https://ksrs.rs/">TOURNAMENTS</a></p>

                </div>
                    
		        <button onclick="sideMenuToggle('Demo2')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Invite friends</button>
                <div id="Demo2" class="w3-hide w3-container">
                    <p class="w3-center"><?php require 'includes/invitefriends.php'; ?></p>
                </div>
                
            </div>      
        </div>
        <br>

    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
        <div class="w3-row-padding">
            <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                        <form method="post" action="function/addpost.php" class="w3-container w3-white w3-text-nasapink w3-margin" enctype="multipart/form-data">
                            <input class="w3-input w3-large" name="postcontent" type="text" placeholder="What's on your mind?" required>
                            <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                            <input type="hidden" name="userid" value="<?=$user->getId()?>">
                            <button type="submit" name="post" class="w3-button w3-theme-nasa"><i class="fas fa-pencil-alt"></i>  Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <?php
            
            $posts = getPostsFriends($user->getId());
            
            if(!empty($posts)) {
                for($j=0;$j < count($posts);$j++){

                    ?>
                    <div class="w3-container w3-card w3-white w3-round w3-margin  w3-margin-bottom-50" id="mainProfile"><br>
                        <img src="image.php?img=<?=$posts[$j]->ProfilePicture?>" alt="<?=$posts[$j]->RealName?>" class="w3-left w3-circle w3-margin-right" style="height:60px;width:60px">
                        <span class="w3-right w3-opacity">Posted on: <?=$posts[$j]->DateCreated?></span>
                        <?php 
                            if($user->getId() == $posts[$j]->UserID){
                                ?>
                                 <form onsubmit="return confirm('Are you sure you want to delete this post?');" method="post" action="function/deletepost.php">
                                    <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>"> 
                                    <button onclick="confirmDelete()" class="w3-right w3-text-black w3-hover-text-grey w3-white w3-border-0"><i class="fa fa-trash"></i></button>
                                </form>
                            <?php
                            } ?>
                        <h4><a href="profiles.php?id=<?=$posts[$j]->UserID?>"><?=$posts[$j]->RealName?></a></h4><br>
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
                        
                       <!--  <div class="w3-row-padding" style="margin:0 -16px">
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
                                    <input type="hidden" name="userliked" value="<?=$posts[$j]->UserId?>"> 
                                    <button type="submit" name="likepost" class="w3-button w3-theme-nasa w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
                                </form>
                            
                            <?php 
                            }else{
                        ?>    
                                <form method="post" action="function/likes.php">    
                                    <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                    <input type="hidden" name="userliked" value="<?=$posts[$j]->UserId?>">
                                    <input type="hidden" name="likeid" value="<?=$likesrow[0]->LikeId?>">
                                    <button type="submit" name="unlikepost" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-check"></i>  Liked</button> 
                                </form>
                            <?php   
                            }
                     
                            
                            ?>
                        <button onclick ="commentToggle('Comment<?=$j?>')" type="button" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>
                        <button class="w3-theme-nasa4" onclick="commentSectionToggle('CommentSection<?=$j?>')">Show all <span id="numberOfComments"><?=count($komentari)?></span> Comments</button>
                            <div id="CommentSection<?=$j?>" class="w3-hide w3-container ">
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
                                                            <form onsubmit="return confirm('Are you sure you want to delete this comment?');"  method="post" action="function/deletecomments.php">
                                                                <input type="hidden" name="commentid" value="<?=$comments[$k]->CommentId?>">
                                                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                                                <input type="hidden" name="usercomment" value="<?=$user->getId()?>">
                                                                <input type="hidden" name="usercommented" value="<?=$posts[$j]->UserId?>">
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
                        <div id="Comment<?=$j?>" class="w3-hide w3-container w3-margin-bottom-32">
                            <form action="function/addcomments.php" method="post">
                                <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                <input type="hidden" name="usercomment" value="<?=$user->getId()?>">
                                <input type="hidden" name="usercommented" value="<?=$posts[$j]->UserId?>"> 
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
            }

            ?>
      
    <!-- End Middle Column -->
    </div>
    



<!--Top Button-->
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up"></i></button>
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>







    <div class="w3-col m2">
        
        <?php 
            $pets  = getUserPets($user->getId());
            if(!empty($pets)){
                for ($p=0; $p < count($pets) ; $p++) { 
                    
                    $suggestions = getPetSuggestions($user->getId(),$pets[$p]->Race);
                    
                    if(!empty($suggestions)){
                        for($s = 0;$s<count($suggestions);$s++){
                            ?>
                            <div class="w3-card w3-round w3-white w3-center w3-padding">
                                <div class="w3-container">
                                    <h3>Suggestion #<?=$s+1?></h3>
                                    <p class="w3-large w3-bold"><?=$suggestions[$s]->PetsName?> <small>(<?=$suggestions[$s]->Race?>)</small></p>
                                                
                                    <img src="image.php?img=<?=$suggestions[$s]->ProfilePicture?>" alt="Forest" style="width:100%;">
                                    <p>This dog is for: <b><?=$suggestions[$s]->TypeOfSale?></b></p>
                                    <p>Owned by <a class="w3-text-teget" href="profiles.php?id=<?=$suggestions[$s]->UserId?>"><?=$suggestions[$s]->RealName?></a></p>
                                    <q class="w3-italic"><?=$suggestions[$s]->About?></q>
                                    <p>-<?=$suggestions[$s]->RealName?></p>
                                    <button class="button w3-hover-grey w3-bold " onclick="return redirectProfile(<?=$suggestions[$s]->UserId?>,'<?=$directoryPath?>')"><i class="w3-xlarge far fa-envelope"></i> Send message to <?=$suggestions[$s]->RealName?></button>
                                </div>
                            </div>
                            <br>
                                    <?php  
                        }
                    }
                }
            }
                ?>
                <!-- <p>Upcoming Events:</p>
                <img src="#" alt="Forest" style="width:100%;">
                <p><strong>Holiday</strong></p>
                <p>Friday 15:00</p>
                <p><button class="w3-button w3-block w3-theme-l4">Info</button></p> -->

        
    </div>
    
  <!-- End Grid -->
    </div>

<br>

<!-- Footer -->

     <footer class="w3-container w3-theme-nasa3">
        <p>Powered by &lt;Uzzi&gt; & &lt;Anci&gt; </p>
    </footer>
 
    <script src="javascript/functions.js">
    </script>

</body>
</html> 
