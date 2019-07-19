<?php 
    header('Cache-Control: no cache'); 
    session_cache_limiter('private_no_expire'); 
    require 'function/session.php';
    require 'function/sqlfunctions.php';


    $_SESSION['userid'] = $user->getId();

      
?><!DOCTYPE html>
<html>
    <title>Meet Puppies | Search Users</title>
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
    

   
<body class="w3-theme-l5">

<!-- Navbar -->
    <?php require 'includes/header.php'; ?>



<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
    <div class="w3-row">
    <!-- Left Column -->
        <div class="w3-col m3">

        
            
    
    <!-- End Left Column -->
        </div>
        
        <!-- Middle Column -->
        <div class="w3-col m7">
             
        <?php
            if(filter_has_var(INPUT_POST, 'searchuser')){
                if(filter_has_var(INPUT_POST, 'user')){
                    $user   = $_POST['user'];
                    $user   = filter_var($user, FILTER_SANITIZE_STRING);
                    $conn   = Konekcija::get();

                    $row    = getUserSearched($user);
                    echo  "<p>Searching for:<span class='w3-bold'> ". $user ." </span></p>";
                    if(!empty($row)){
                        echo "<h2><i class='fas fa-user'></i> Users:</h2>";
                        for ($i=0; $i < count($row) ; $i++) { 
                            ?>  
                                <div class="w3-container w3-card w3-margin w3-border-nasaplava ">
                                    
                                    <h1><img style="width:130px" src="image.php?img=<?=$row[$i]->ProfilePicture?>"> <a href="profiles.php?id=<?=$row[$i]->UserId?>"><?=$row[$i]->RealName?></a></h1>
                                </div>

                            <?php
                        }
                    }else{
                        echo "No Users found <br>";
                    }

                    $row1 = getGroupSearched($user);
                    if(!empty($row1)){
                        echo "<h2><i class='fas fa-users'></i> Groups:</h2>";
                        for ($j=0; $j < count($row1) ; $j++) { 
                            ?>  
                                <div class="w3-container w3-card w3-margin w3-border-nasaplava ">
                                    
                                    <h1><img style="width:130px" src="image.php?img=<?=$row1[$j]->GroupPicture?>"> <a href="group.php?id=<?=$row1[$j]->GroupId?>"><?=$row1[$j]->GroupName?></a></h1>
                                </div>

                            <?php
                        }
                    }else{
                        echo "No Groups found <br>";
                    }
                }
                    
            }
            
        ?>  
            
          
        <!-- End Middle Column -->
        </div>
        
        <!-- Right Column -->
        <div class="w3-col m2">
           
        
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
