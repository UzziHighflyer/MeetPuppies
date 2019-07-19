<?php 
    require 'function/session.php';
    require 'function/sqlfunctions.php';


      
?><!DOCTYPE html>
<html>
    <title>Meet Puppies | <?=$user->getFullname()?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="w3-style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="javascript/toggleprofile.js"></script>
    <script>
        function confirmDelete() { 
            if (window.confirm('Do you want to delete this post?')){
                alert("Delete!") 
                window.location.href = 'function/deletepost.php';
            }
        }

        function confirmDeleteComment() { 
            return window.confirm('Are you sure you want to delete this comment?')
        }
    </script>

   
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
                <h3 class="w3-center"><a href="#"><?=$user->getFullname()?></a></h3>
                <p class="w3-center"><img src="image.php?img=<?=$user->getProfilepicture()?>"  class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                <p id="userid" class="w3-hide"><?=$user->getId()?></p>
                 <hr>
                <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?=$user->getCity()?> , <?=$user->getCountry()?></p>
                <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?=$user->getBirthdate();?></p>
                <p><i class="fas fa-calendar-alt fa-fw w3-margin-right w3-text-theme"></i>Joined: <?=$user->getDatecreated()?></p>
            </div>
        </div>
        <br>  
      
      <!-- Accordion -->
        <div class="w3-card w3-round">
            <div class="w3-white">
                    <button onclick="sideMenuToggle('Demo1')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
                    
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
                                        <form class="w3-padding" method="POST" enctype="multipart/form-data">
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
                    
                <button onclick="sideMenuToggle('Demo3')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-images fa-fw w3-margin-right"></i> My Photos of Pets</button>
                <div id="Demo3" class="w3-hide w3-container">
                    <div class="w3-row-padding">
                        <br>
                        <?php 
                            $petProfilePicture = getPetsProfilePicture($user->getId());
                            if(!empty($petProfilePicture)){
                                for ($pp=0; $pp < count($petProfilePicture) ; $pp++) { 
                                    ?>
                                        <div class="w3-half">
                                            <p class="w3-bold"><?=$petProfilePicture[$pp]->PetsName?></p>
                                            <img src="image.php?img=<?=$petProfilePicture[$pp]->ProfilePicture?>" style="width:100%" class="w3-margin-bottom">
                                        </div>
                                    <?php
                                }
                            }
                            $petImages = getPetsImages($user->getId());
                            if(!empty($petImages)){
                                for ($pi=0; $pi < count($petImages); $pi++) {     
                        ?>
                                    <div class="w3-half">
                                        <p class="w3-bold"><?=$petImages[$pi]->PetsName?></p>
                                        <img src="image.php?img=<?=$petImages[$pi]->PetImage?>" style="width:100%" class="w3-margin-bottom">
                                    </div>

                        <?php 
                                }
                            }
                        ?>
                        
                    </div>
                </div>
                <button onclick="sideMenuToggle('Demo4')" class="w3-button w3-block w3-theme-nasa1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Friends</button>
                <div id="Demo4" class="w3-hide w3-container">
                    <?php 
                        $red = getUserFriends($user->getId());
                        if(!empty($red)){
                            for ($f=0; $f < count($red); $f++) { 
                    ?>
                            <p class="w3-left w3-block"><img style="width:50px" src="image.php?img=<?=$red[$f]->ProfilePicture?>"><a href="profiles.php?id=<?=$red[$f]->UserId?>"><?=$red[$f]->RealName?></a></p>
                    
                    <?php 
                            }
                        }else{
                           ?> <p class="w3-left w3-block">You have no friends yet :( </p>
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
                <button class="w3-button w3-theme-nasa w3-bold w3-border w3-border-teget" id="addPet">Add a Pet</button>
            </li>
            <?php  
                $pets = getUserPets($user->getId());

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
                                <form method="post" action="function/addpetpictures.php" enctype="multipart/form-data">
                                    <label class="w3-bold">Pet Pictures</label>
                                    <input class="w3-input w3-bold" name="pictures[]" type="file" multiple="" placeholder="Profile picture" required>
                                    <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                    <input type="hidden" name="petid" value="<?=$pets[$i]->PetsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input class="3-button w3-border-0 w3-teget w3-hover-nasapink w3-ripple w3-padding w3-bold" type="submit" value="Add Pictures" name="addpetpictures">
                                </form>

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
                            <footer class="w3-container w3-nasapink">
                                <b>Meet<i class="fa fa-paw"></i>Puppies</b>
                            </footer>
                        </div>
                    </div>
            <?php
                    }
                }else{
            ?>
                        <li class="w3-bar">
                           <p>You have no pets</p>
                        </li>

                    <?php
                }

            ?>

        </ul>


    	

  
        <!-- Alert Box -->
            
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">

        <div id="mainProfile">
            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container">
                            <form method="post" action="function/addpost.php" class="w3-container w3-white w3-text-nasapink w3-margin" enctype="multipart/form-data">
                                <input class="w3-input w3-large" name="postcontent" type="text" placeholder="What's on your mind?" required>
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                <button type="submit" name="post" class="w3-button w3-theme-nasa"><i class="fas fa-pencil-alt"></i>  Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <?php
                if(isset($_GET['post']) && is_numeric($_GET['post'])){
                    $postid = $_GET['post'];
                    $posts = getUserPost($user->getId(),$postid);
                }else{
                    $posts = getUserPosts($user->getId());
                }

                if(!empty($posts)) {
                    for($j=0;$j < count($posts);$j++){
                        ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin w3-margin-bottom-50" id="mainProfile"><br>
                            <img src="image.php?img=<?=$user->getProfilepicture()?>" alt="<?=$user->getFullname()?>" class="w3-left w3-circle w3-margin-right" style="width:60px;height:60px">
                            <span class="w3-right w3-opacity">Posted on: <?=$posts[$j]->DateCreated?></span>
                            <form  onsubmit="return confirm('Are you sure you want to delete this post?');"  method="post" action="function/deletepost.php">
                                <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>"> 
                                <button  class="w3-right w3-text-black w3-hover-text-grey w3-white w3-border-0"><i class="fa fa-trash"></i></button>
                            </form>
                            
                            <h4><?=$user->getFullname()?></h4><br>
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
                            
                          
                            <?php 
                            
                            $likesrow = checkIfUserLiked($user->getId(),$posts[$j]->PostsId);
                            if(empty($likesrow)){
                        ?>
                                <form method="post" action="function/likes.php">    
                                    <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                    <button type="submit" name="likeyourpost" class="w3-button w3-theme-nasa w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
                                </form>
                            
                            <?php 
                            }else{
                        ?>    
                                <form method="post" action="function/likes.php">    
                                    <input type="hidden" name="postid" value="<?=$posts[$j]->PostsId?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <input type="hidden" name="userlike" value="<?=$user->getId()?>">
                                    <input type="hidden" name="likeid" value="<?=$likesrow[0]->LikeId?>">
                                    <button type="submit" name="unlikeyourpost" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-check"></i>  Liked</button> 
                                </form>
                            <?php   
                            }
                            ?>
                            <button onclick ="commentToggle('Comment<?=$j?>')" type="button" class="w3-button w3-theme-nasa1 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>

                            <button class="w3-theme-nasa4" onclick="commentSectionToggle('CommentSection<?=$j?>')">Show all <span id="numberOfComments"><?=count($komentari)?></span>  Comments</button>
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
                                                            <form  onsubmit="return confirm('Are you sure you want to delete this comment?');" method="post" action="function/deletecomments.php">
                                                                <input type="hidden" name="commentid" value="<?=$comments[$k]->CommentId?>">
                                                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>"> 
                                                                <button type="submit" name="selfdeletecomment" class="w3-right w3-text-black w3-hover-text-grey w3-white w3-border-0"><i class="fas fa-times"></i></button>
                                                            </form>
                                                        <?php
                                                        } ?>
                                                    <h4><?=$comments[$k]->RealName?></h4><br>
                                                    <p class="w3-large w3-wordwrap" ><?=$comments[$k]->CommentContent?></p>
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
                                <input type="hidden" name="userid" value="<?=$user->getId()?>">
                                <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">  
                                <input id="commentText" class="w3-input w3-large" name="selfpostcomment" type="text" placeholder="Any Comment?" required>
                                <input id="commentButton" class="w3-button w3-theme-nasa1 w3-margin-bottom w3-bold" name="commentbutton" type="submit" value="Comment" required>
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
            </div>
        <!-- Add a pet -->

        <form action="function/addpets.php" method="post" class="w3-container w3-card-4 w3-white w3-text-nasapink w3-margin" enctype="multipart/form-data" id="petsForm">
            <h2 class="w3-center w3-text-teget w3-bold">Add a Pet</h2>
 
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-user"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" name="petname" type="text" placeholder="Pet Name" required>
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-dog"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" name="race" type="text" placeholder="Race" required>
                </div>
            </div>


            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-calendar-alt"></i></div>
                <div class="w3-rest">
                    <label class="w3-bold">Date of birth:</label>
                    <input class="w3-input" name="dateofbirth" type="date" placeholder="Date of birth" required>
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class=" w3-xxlarge fas fa-venus-mars" required></i></div>
                <div class="w3-rest">
                    <input class="w3-radio" type="radio" name="gender" value="M" checked>
                    <label class="w3-bold">Male</label>

                    <input class="w3-radio" type="radio" name="gender" value="F">
                    <label class="w3-bold">Female</label>
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class=" w3-xxlarge fas fa-paw"></i></div>
                <div class="w3-rest">
                    <input class="w3-check" type="checkbox" name="chipped" value="1">
                    <label class="w3-bold">Chipped</label> <br>

                    <input class="w3-check" type="checkbox" name="vaccinated" value="1">
                    <label class="w3-bold">Vaccinated</label><br>

                    <input class="w3-check" type="checkbox" name="tournament" value="1">
                    <label class="w3-bold">Ever been to exhibition of dogs.</label>

                </div>
            </div>

            <input type="hidden" name="userid" value="<?=$user->getId()?>">

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-star"></i></div> 
                <div class="w3-rest">
                    <select class="w3-select w3-border w3-border-nasapinks" name="rate">
                        <option value="" disabled selected>Rate your pet</option>
                        <?php for($i = 0; $i<=10;$i++){
                            ?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php
                        }?>
                    </select>
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class=" w3-xxlarge fas fa-dollar-sign"></i></div>
                <div class="w3-rest">
                    <select class="w3-select w3-border w3-border-nasapinks" name="typeof">
                        <option value="" disabled selected>Type of registration</option>
                        <option value="Breeding">Breeding</option>
                        <option value="Sale">Sale</option>
                    </select>

                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-bone"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" name="about" type="text" placeholder="Tell us something about your pet." required>
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-image"></i></div>
                <div class="w3-rest">
                    <label class="w3-bold">Profile picture</label>
                    <input class="w3-input w3-bold" name="picture" type="file" placeholder="Profile picture" required>
                </div>
            </div>

            <button class="w3-button  w3-block w3-section w3-teget w3-hover-nasapink w3-ripple w3-padding w3-bold" id="registerDugme" value="register" name="add">Add a Pet</button>

        </form>
      
        
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
       
        <?php 
            $friendrequest = getFriendRequests($user->getId());
            if(!empty($friendrequest)){
                for($f=0;$f < count($friendrequest);$f++){
        ?>

                <div class="w3-card w3-round w3-white w3-center">
                    <div class="w3-container">
                            <p>Friend Request</p>
                            <img src="image.php?img=<?=$friendrequest[$f]->ProfilePicture?>" alt="Avatar" style="width:50%"><br>
                            <span><?=$friendrequest[$f]->RealName?></span>
                        <div class="w3-row w3-opacity">
                            <div class="w3-half">
                                <form action="function/friendrequest.php" method="post">
                                    <input type="hidden" name="sender" value="<?=$friendrequest[$f]->Sender?>">
                                    <input type="hidden" name="reciever" value="<?=$friendrequest[$f]->Reciever?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
                                    <button class="w3-button w3-block w3-green w3-section" name="acceptrequest" title="Accept"><i class="fa fa-check"></i></button>
                                </form>
                            </div>
                            <div class="w3-half">
                                <form action="function/friendrequest.php" method="post">
                                    <input type="hidden" name="sender" value="<?=$friendrequest[$f]->Sender?>">
                                    <input type="hidden" name="reciever" value="<?=$friendrequest[$f]->Reciever?>">
                                    <input type="hidden" name="pageurl" value="<?=$_SERVER['REQUEST_URI']?>">
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
             ?>
      
      
      <!--   <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
             <p>ADS</p>
        </div>
        <br>
      
        <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
            <p><i class="fa fa-bug w3-xxlarge"></i></p>
        </div>
       -->
    
    </div>
    
  <!-- End Grid -->
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
