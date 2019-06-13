	$(document).ready(function() {
        $('#registerForm').validate({
            rules:{
                fullname:{
                    required:true,
                    minlength:2
                },
                email:{
                    required:true,
                    email:true
                },
                password:{
                    required:true,
                    minlength:8
                },
                repassword:{
                    required:true,
                    equalTo:'#password'
                },
                city:{
                    required:true
                },
                country:{
                    required:true
                },
                dateofbirth:{
                    required:true
                },
                picture:{
                    required:true,
                    extension: "jpg|jpeg|png"
                }
            },
            messages:{
                fullname: "Please enter your full name",
                email: "Please enter a valid email adress",
                password:{
                    require:"Please provide a password",
                    minlength:"Password must have at least 8 characters"
                },
                repassword:{
                    require:"Please retype your password",
                    equalTo:"Passwords do not match"
                },
                city: "Please enter your city",
                country: "Please enter your country",
                dateofbirth: "Please enter your birth date",
                picture: {
                    require:"Please choose your profile picture",
                    extension:"Please enter valid extension"
                }
            },
           
        });

        $('#registerForm').submit(function(e){
                e.preventDefault();
                var data = new FormData(this);
                
                $.ajax({
                    type : 'POST',
                    url : 'function/authentification.php',
                    data : data,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#error").fadeOut();
                        $("#registerDugme").html('<i class="fas fa-circle-notch fa-spin"></i>   Sending ...');

                    },
                    success : function(response) {
                        if(response==1){
                            $("#error").fadeIn(1000, function(){
                                $("#error").html('<div id="resultInfo" class="w3-panel w3-red w3-border"><h3>Error</h3><p>You did not register. Check your data before proceeding.</p></div>');
                                $("#registerDugme").html('Register');
                            });
                        } else if(response=="registered"){
                            $("#error").fadeIn(1000, function(){    
                                $("#error").html('<div id="resultInfo" class="w3-panel w3-green w3-border"><h3>Welcome</h3><p>You successfully registred to our app.</p></div>');
                                $("#registerDugme").html('Register');
                            });
                        } else if(response=="email"){
                            $("#error").fadeIn(1000, function(){    
                                $("#error").html('<div id="resultInfo" class="w3-panel w3-red w3-border"><h3>Error</h3><p>Email was already taken .</p></div>');
                                $("#registerDugme").html('Register');
                            });
                        }
                    }
                });
                return false;
        });
       

    });


    