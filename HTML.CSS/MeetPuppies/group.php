<?php
    require 'function/session.php';
    require 'function/sqlfunctions.php';

    require 'function/getgroup.php';
   
?><!DOCTYPE html>
<html>
    <title>Meet Puppies | <?=$group->getGroupname()?></title>
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
<body class="w3-theme-l5">

    
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
                <h3 class="w3-center"><a href="group.php?id=<?=$group->getId()?>"><?=$group->getGroupname()?></a></h3>
                <p class="w3-center"><img src="image.php?img=<?=$group->getGrouppicture()?>" class="w3-circle" style="height:106px;width:106px" alt="<?=$group->getGroupname()?>"></p>
                
                <hr>
		        <?php 
                    $checkifuser    = checkIfUserMember($user->getId(),$group->getId());
                    $checkifrequest = checkIfMemberRequestSent($user->getId(),$group->getId()); 
                    if(empty($checkifuser)){
                        if(empty($checkifrequest)){
                        ?>
                            <form method="POST" action="function/groupmember.php">
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="groupid" value="<?=$group->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">    
                                <button type="submit" name="joingroup" class="w3-button w3-theme-nasa2 w3-margin-bottom"><i class="fas fa-plus"></i>  JOIN GROUP</button>
                            </form>
                        <?php
                        }else{
                        ?>
                            <form method="POST" action="function/groupmember.php">
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="groupid" value="<?=$group->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">    
                                <button type="submit" name="cancelrequest" class="w3-button w3-teget w3-margin-bottom"><i class="fas fa-share"></i>  REQUEST SENT</button>
                            </form>
                        <?php
                        }
                    }else{
                        ?>  
                            <form method="POST" onsubmit="return confirm('Are you sure you leave <?=$group->getGroupname()?>')" action="function/groupmember.php">
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="groupid" value="<?=$group->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">    
                                <button type="submit" name="leavegroup" class="w3-button w3-green w3-margin-bottom"><i class="fas fa-check"></i>  ALREADY MEMBER</button>
                            </form>
                        <?php
                    }
                ?>
		            


                <p><span class="w3-bold">Description: </span><?=$group->getDescription()?></p>
            </div>
        </div>
        <br>

       

      
      <!-- Accordion -->
        <div class="w3-card w3-round">
            <div class="w3-white">
                    <button onclick="sideMenuToggle('Demo1')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Admins</button>
                    <div id="Demo1" class="w3-hide w3-container">
                        <?php 
                            $admin = getGroupAdmin($group->getId());
                            if(!empty($admin)){
                                for ($a=0; $a < count($admin); $a++) { 
                                    ?>
                                        <p><a href="profiles.php?id=<?=$admin[$a]->UserId?>"><?=$admin[$a]->RealName?></a></p>
                                    <?php
                                }
                            }
                        ?>
                    </div>

                    
                <button onclick="sideMenuToggle('Demo3')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Photos</button>
                <div id="Demo3" class="w3-hide w3-container">
                    <div class="w3-row-padding">
                        <!-- <br>
                        <div class="w3-half">
                            <img src="/w3images/.jpg" style="width:100%" class="w3-margin-bottom">
                        </div>
                        <div class="w3-half">
                            <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
                        </div>
                        <div class="w3-half">
                            <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
                        </div>
                        <div class="w3-half">
                            <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
                        </div>
                        <div class="w3-half">
                            <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
                        </div>
                        <div class="w3-half">
                            <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">

                        </div> -->
                    </div>
                </div>
                    <button onclick="sideMenuToggle('Demo2')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Invite Friends</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <p class="w3-center"><?php include 'includes/invitefriends.php'; ?></p>
                    </div>
            </div>      
        </div>
        <br>



      
      <!-- Pets --> 
        <div class="w3-card w3-round w3-white w3-hide-small">
            <div class="w3-container">
                <p>Members</p>
                <p>
                    <?php 
                        $groupmembers = getGroupMembers($group->getId());
                        

                        if(!empty($groupmembers)){
                            for ($gm=0; $gm < count($groupmembers) ; $gm++) {
                                $checkifadmin = checkIfAdmin($groupmembers[$gm]->UserId,$group->getId()); 
                                ?>
                                    <span class="w3-tag w3-small w3-theme-nasa1 <?=(!empty($checkifadmin))?'w3-bold':''?>"><a href="profiles.php?id=<?=$groupmembers[$gm]->UserId?>"><?=$groupmembers[$gm]->RealName?></a></span>
                                <?php
                            }
                        }
                    ?>
                    
                </p>
            </div>
        </div>
        <br> 
      
        
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
        <?php 
            if(!empty($checkifuser)){
        ?>
            <div id="mainProfile">
                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container">
                                <form method="post" action="function/grouppost.php" class="w3-container w3-white w3-text-nasapink w3-margin" enctype="multipart/form-data">
                                    <input class="w3-input w3-large" name="grouppostcontent" type="text" placeholder="What's on your mind?" required>
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                    <input type="hidden" name="groupid" value="<?=$group->getId()?>">
                                    <button type="submit" name="grouppost" class="w3-button w3-theme-nasa"><i class="fas fa-pencil-alt"></i>  Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $groupposts = getGroupPosts($group->getId());
                    if(!empty($groupposts)){
                        for ($gp=0; $gp < count($groupposts) ; $gp++) {
                        ?> 
                            <div class="w3-container w3-card w3-white w3-round w3-margin  w3-margin-bottom-50" id="mainProfile"><br>
                                <img src="image.php?img=<?=$groupposts[$gp]->ProfilePicture?>" alt="<?=$groupposts[$gp]->RealName?>" class="w3-left w3-circle w3-margin-right" style="width:60px;height:60px">
                                <span class="w3-right w3-opacity">Posted on: <?=$groupposts[$gp]->DateCreated?></span>
                                <?php 
                                if($groupposts[$gp]->GroupPostUserId == $user->getId()){
                                 ?>
                                    <form  onsubmit="return confirm('Are you sure you want to delete this post?');"  method="post" action="function/grouppost.php">
                                        <input type="hidden" name="postid" value="<?=$groupposts[$gp]->GroupPostId?>">
                                        <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>"> 
                                        <button name="deletepost"class="w3-right w3-text-black w3-hover-text-grey w3-white w3-border-0"><i class="fa fa-trash"></i></button>
                                    </form>
                                <?php  
                                }
                                ?>
                                
                                <h4><a href="profiles.php?id=<?=$groupposts[$gp]->UserId?>"><?=$groupposts[$gp]->RealName?></a></h4><br>
                                <p class="w3-large w3-wordwrap"><?=$groupposts[$gp]->GroupPostContent?></p>
                                <?php   
                        
                                    $lajkovi = getPostLikeNumberGroup($groupposts[$gp]->GroupPostId);
                                    $komentari = getPostCommentNumberGroup($groupposts[$gp]->GroupPostId);

                                    if(!empty($lajkovi)){
                                        ?> <a style="cursor:pointer" onclick="return showLikes(<?=$groupposts[$gp]->GroupPostId?>);"><i class='w3-text-teget fa fa-thumbs-up'></i><?=count($lajkovi)?></a>
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
                                
                              
                                <?php 
                                
                                $likesrow = checkIfUserLikedGroup($user->getId(),$groupposts[$gp]->GroupPostId);
                                if(empty($likesrow)){
                            ?>
                                    <form method="post" action="function/grouplikes.php">    
                                        <input type="hidden" name="postid" value="<?=$groupposts[$gp]->GroupPostId?>">
                                        <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                        <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                        <button type="submit" name="likepost" class="w3-button w3-theme-nasa w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
                                    </form>
                                
                                <?php 
                                }else{
                            ?>    
                                    <form method="post" action="function/grouplikes.php">    
                                        <input type="hidden" name="postid" value="<?=$groupposts[$gp]->GroupPostId?>">
                                        <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                        <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                        <input type="hidden" name="likeid" value="<?=$likesrow[0]->GroupLikeId?>">
                                        <button type="submit" name="unlikepost" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-check"></i>  Liked</button> 
                                    </form>
                                <?php   
                                }
                                ?>
                                <button onclick ="commentToggle('Comment<?=$gp?>')" type="button" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>

                                <button class="w3-theme-nasa4" onclick="commentSectionToggle('CommentSection<?=$gp?>')">Show all <span id="numberOfComments"><?=count($komentari)?></span>  Comments</button>
                                <div id="CommentSection<?=$gp?>" class="w3-hide w3-container">
                                    <div id="commentcounter<?=$gp?>">
                                    <?php
                                        $comments = getPostCommentsGroup($groupposts[$gp]->GroupPostId);   


                                        if(!empty($comments)){
                                            for($k=0;$k <count($comments);$k++){
                                                ?>
                                                
                                                    <div class="w3-container w3-card w3-white w3-round w3-margin-bottom w3-padding">
                                                        <img src="image.php?img=<?=$comments[$k]->ProfilePicture?>" alt="<?=$comments[$k]->RealName?>" class="w3-left w3-circle w3-margin-right" style="width:50px;height:50px">
                                                        <span class="w3-right w3-opacity">Posted on: <?=$comments[$k]->DateOfCreation?></span>
                                                         <?php 
                                                            if($user->getId() == $comments[$k]->UserId){
                                                                ?>
                                                                <form  onsubmit="return confirm('Are you sure you want to delete this comment?');" method="post" action="function/groupcomment.php">
                                                                    <input type="hidden" name="commentid" value="<?=$comments[$k]->GroupCommentId?>">
                                                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>"> 
                                                                    <button type="submit" name="deletecommentbutton" class="w3-right w3-text-black w3-hover-text-grey w3-white w3-border-0"><i class="fas fa-times"></i></button>
                                                                </form>
                                                            <?php
                                                            } ?>
                                                        <h4><?=$comments[$k]->RealName?></h4><br>
                                                        <p class="w3-large w3-wordwrap"><?=$comments[$k]->GroupCommentsContent?></p>
                                                    </div>
                                            <?php
                                            }
                                        }
                                    ?>
                                    </div>
                                </div> 
                                    
                        
                            </div>
                            <div id="Comment<?=$gp?>" class="w3-hide w3-container">
                                <form action="function/groupcomment.php" method="post">
                                    <input type="hidden" name="postid" value="<?=$groupposts[$gp]->GroupPostId?>">
                                    <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">  
                                    <input id="commentText" class="w3-input w3-large" name="commentcontent" type="text" placeholder="Any Comment?" required>
                                    <input id="commentButton" class="w3-button w3-theme-nasa1 w3-margin-bottom w3-bold" name="commentbutton" type="submit" value="Comment" required>
                                </form> 
                            </div>
                            <div id="pid<?=$groupposts[$gp]->GroupPostId?>" class="w3-modal">
                                <div class="w3-modal-content w3-animate-top w3-card-4 ">
                                    <header class="w3-container w3-nasapink"> 
                                        <span onclick="document.getElementById('pid<?=$groupposts[$gp]->GroupPostId?>').style.display='none'" 
                                        class="w3-button w3-display-topright">&times;</span>
                                        <h2>Likes</h2>
                                    
                                
                                    </header>
                                    
                                        <?php 
                                            $row = getPostLikeUsersGroup($groupposts[$gp]->GroupPostId);
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



            </div>

            <?php  
            }else{
                ?>
                    <div class="w3-container">
                        <h2><i class='fas fa-lock'></i>You are not member of this group.</h2>
                    </div>
                <?php
            }
            ?>
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->




    <div class="w3-col m2">
        <?php 
            $checkifadmin = checkIfAdmin($user->getId(),$group->getId());
            $memberrequests = getMemberRequests($group->getId());
            if(!empty($checkifadmin)){
                if(!empty($memberrequests)){
                    for($c = 0;$c < count($memberrequests);$c++){
                    ?>  
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                    <p>Member Request</p>
                                    <img src="image.php?img=<?=$memberrequests[$c]->ProfilePicture?>" alt="Avatar" style="width:50%"><br>
                                    <span><?=$memberrequests[$c]->RealName?></span>
                                <div class="w3-row w3-opacity">
                                    <div class="w3-half">
                                        <form method="POST" action="function/groupmember.php">
                                            <input type="hidden" name="groupid" value="<?=$group->getId()?>">
                                            <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                            <input type="hidden" name="userid" value="<?=$memberrequests[$c]->UserId?>">
                                            <button class="w3-button w3-block w3-green w3-section"  name="acceptrequest" title="Accept"><i class="fa fa-check"></i></button>
                                        </form>
                                    </div>
                                    <div class="w3-half">
                                        <form method="POST" action="function/groupmember.php">
                                            <input type="hidden" name="groupid" value="<?=$group->getId()?>">
                                            <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                            <input type="hidden" name="userid" value="<?=$memberrequests[$c]->UserId?>">
                                            <button class="w3-button w3-block w3-red w3-section" name="declinerequest" title="Decline"><i class="fa fa-remove"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                    <?php
                    }
                }
            }
        ?>
      
            
      
        
      
    <!-- End Right Column  -->
    </div>
    

    </div>



<br>

<!-- Footer -->

    <footer class="w3-container w3-theme-nasa3">
        <p>Powered by &lt;Uzzi&gt; & &lt;Anci&gt; </p>
    </footer>
 
    
</body>
</html> 
