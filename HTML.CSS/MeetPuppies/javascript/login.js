    $(document).ready(function() {
        $('#loginForm').validate({
            rules:{
                email:{
                    required:true,
                    email:true
                },
                password:{
                    required:true,
                },
               
            },
            messages:{
                email: "Please enter your email adress",
                password:"Please enter your password"
            },
            submitHandler:submitForm1
        });
        function submitForm1() {
            var data = $("#loginForm").serialize();
            $.ajax({
                type : 'POST',
                url : 'function/login.php',
                data : data,
                beforeSend: function() {
                    $("#loginDugme").html('<i class="fas fa-circle-notch fa-spin"></i>   Checking data...');
                },
                success : function(response) {

                    if(response=="email"){
                        alert('Wrong email. Try again.');
                        $("#loginDugme").html('Login');

                    }else if(response=="logedin"){
                        $("#btn-submit").html('<i class="fas fa-circle-notch fa-spin"></i>   Signing Up ...');
                        window.location = 'homepage.php';
                    }else if(response=="password"){
                        alert('Wrong password. Try again.');
                        $("#loginDugme").html('Login');

                    }else if(response=="nonvalidemail"){
                        alert('Email not valid.');
                        $("#loginDugme").html('Login');

                    }else if(response=="required"){
                        alert('Please enter all fields.');
                        $("#loginDugme").html('Login');

                    }
                }
            });
            return false;
        }

    });