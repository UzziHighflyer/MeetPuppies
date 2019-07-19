<?php  
    if(!file_exists('config.php')){
        header('location:../index.php');
    }
    
?><!DOCTYPE html>
<html>
    <title>Meet Puppies | Log In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="w3-style.css">
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    </style>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="javascript/passwordverify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.js"></script>
    <script src="//geodata.solutions/includes/countrystatecity.js"></script>
    <script src="javascript/register.js"></script>
    <script src="javascript/login.js"></script>
    <script src="javascript/functions.js"></script>
    
    
<body class="w3-theme-l5">

<!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-nasa w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a href="homepage.php" class="w3-bar-item w3-button w3-padding-large w3-theme-nasa w3-hover-white"><i class="fa fa-home w3-margin-right"></i><b>Meet<i class="fa fa-paw"></i>Puppies</b></a>
            
            <div class="w3-row-padding w3-theme-nasa w3-half w3-container">
                <form method="post" action="function/login.php" id="loginForm">
                    <div class="w3-third w3-bar-item">
                        <input class="w3-input w3-border" name="email" type="email" placeholder="Email" required>
                    </div>
                    <div class="w3-third w3-bar-item">
                        <input class="w3-input w3-border" name="password" type="password" placeholder="Password" required>
                        <a href="#" class="w3-small">Forgot password?</a>
                    </div>
                    <div class="w3-quarter w3-bar-item">
                        <input type="submit" name="login" id="loginDugme" value="Login" class="w3-button w3-theme-nasa1 w3-margin-bottom w3-bold w3-hover-white">
                    </div>
                    
                </form>

                    

            </div>
            
            
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
                
            </a>
        </div>
    </div>

    

<!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
    </div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
    <div class="w3-row">
    <!-- Left Column -->
    <!-- <div class="w3-col m3">
      Profile 
        
    
    End Left Column
    </div> -->
    
    <!-- Middle Column -->
    <div class="w3-col m7 w3-margin-top w3-auto">
    
        <form action="function/authentification.php" method="post" id="registerForm" class="w3-container w3-card-4 w3-white w3-text-nasapink w3-margin"  enctype="multipart/form-data">
            <h2 class="w3-center w3-text-teget w3-bold">Register</h2>
 
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" name="fullname" type="text" placeholder="Full Name">
                </div>
            </div>


            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-envelope"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" id="emailInput" name="email" type="email" placeholder="Email">
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-key"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" id="password" name="password" type="password" placeholder="Password">
                </div>
            </div>
            <p class="w3-small">Password must be atleast 8 characters</p>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-key"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" id="repassword" name="repassword" type="password" placeholder="Confirm Password">
                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-city"></i></div>
                <div class="w3-rest">
                   <select name="country" class="countries order-alpha w3-input w3-margin w3-quarter" id="countryId">
                        <option value="">Select Country</option>
                    </select>
                    <select name="state" class="states order-alpha w3-input w3-margin w3-quarter" id="stateId">
                        <option value="">Select State</option>
                    </select>
                    <select name="city" class="cities order-alpha w3-input w3-margin w3-quarter" id="cityId">
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>

            <!-- <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-flag"></i></div>
                <div class="w3-rest">
                    <input class="w3-input" name="country" type="text" placeholder="Country">
                </div>
            </div> -->

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-calendar-alt"></i></div>
                <div class="w3-rest">
                    <label class="w3-bold">Date of birth:</label>
                    <input class="w3-input" name="dateofbirth" type="date" placeholder="Date of birth">
                </div>
            </div>



            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class=" w3-xxlarge fa fa-venus-mars"></i></div>
                <div class="w3-rest">
                    <input class="w3-radio" type="radio" name="gender" value="M" checked>
                    <label class="w3-bold">Male</label>

                    <input class="w3-radio" type="radio" name="gender" value="F">
                    <label class="w3-bold">Female</label>

                </div>
            </div>

            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-image"></i></div>
                <div class="w3-rest">
                    <label class="w3-bold">Profile picture</label>
                    <input class="w3-input w3-bold" name="picture" type="file" placeholder="Profile picture">
                </div>
            </div>

            <div id="error">
            </div>


            <button class="w3-button  w3-block w3-section w3-teget w3-hover-nasapink w3-ripple w3-padding w3-bold" type="submit" id="registerDugme" value="registe" name="register">Register</button>

        </form>

        
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2 w3-margin-top w3-large w3-margin-left">
        <img src="image.php?img=puppies.png" style="width:750px">
    </div> 
    
  <!-- End Grid -->
    </div>
  
<!-- End Page Container -->
</div>
<br>

    <?php 
        if (isset($_GET['register']) && is_numeric($_GET['register'])) {
            if($_GET['register'] == 1){
                ?>
                    <script>alert('Uspesno ste se registrovali')</script>
                <?php
                unset($_GET['register']);
            }else{
                ?>
                    <script>alert('Neuspesno logvanje')</script>
                <?php
                unset($_GET['register']);
            }
        }
    ?>

<!-- Footer -->

    <footer class="w3-container w3-theme-nasa1 w3-absolute">
        <p>Powered by &lt;Uzzi&gt; & &lt;Anci&gt; </p>
    </footer>
 
    <script>
    
       

        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            }else { 
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className = 
                x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }

        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else { 
                x.className = x.className.replace(" w3-show", "");
            }
        }

        var x = document.getElementById("notificationlist").childElementCount;
        document.getElementById("numberofnotifications").innerHTML = x;
    </script>

</body>
</html> 