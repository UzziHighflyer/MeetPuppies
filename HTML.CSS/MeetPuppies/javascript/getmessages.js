   $(document).ready(function() {
        var user1 = $('#sender').val();
        var user2 = $('#reciever').val();
        

        function getMessages(){  
            $.ajax({    
                type: "GET",
                url: "function/getmessages.php",
                data:{user1:user1,user2:user2},             
                dataType: "html",                  
                success: function(response){                    
                    $("#messagecontainer").html(response); 
                    getMessages();
                }

            });

        }
        setTimeout(getMessages,2000);
    });





