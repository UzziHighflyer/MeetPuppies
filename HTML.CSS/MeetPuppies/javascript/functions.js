// Accordion
        function sideMenuToggle(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                
            }else {
                x.className = x.className.replace("w3-show", "");    
                
            }
        }

        function petsToggle(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                
            }else {
                x.className = x.className.replace("w3-show", "");  
                
            }
        }

        function commentToggle(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
               
            }else {
                x.className = x.className.replace("w3-show", "");   
               
            }
        }

         function commentSectionToggle(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            }else {
                x.className = x.className.replace("w3-show", ""); 
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

        function showNewName(value){
            if(value.length == 0){
                document.getElementById("NewNameFull").style.display = "none";
            }else{
                document.getElementById("NewNameFull").style.display = "block";
            }
            document.getElementById("NewName").innerHTML = value;    
        }

        var x = document.getElementById("notificationlist").childElementCount;
        document.getElementById("numberofnotifications").innerHTML = x;
        if(x == 0){
            var showNumberOfNotifications = document.getElementById("numberofnotifications");
            showNumberOfNotifications.style.display = "none";
        }

        var z = document.getElementById("friendrequestlist").childElementCount;
        document.getElementById("numberoffriendrequest").innerHTML = z;
        if(z == 0){
            var showNumberOfFriendrequests = document.getElementById("numberoffriendrequest");
            showNumberOfFriendrequests.style.display = "none";
        }

        var m = document.getElementById("messagelist").childElementCount;
        var seen  = document.getElementsByClassName("w3-seen").length;
        if(seen > 0){
            document.getElementById("numberofmessages").innerHTML = m - seen - (1*seen);
        }else{
            document.getElementById("numberofmessages").innerHTML = m
        }
        
        if(document.getElementById("numberofmessages").innerHTML == 0){
            var showNumberOfMessages = document.getElementById("numberofmessages");
            showNumberOfMessages.style.display = "none";
        }

        // function resetNotifications(id,type){
        //     var id = 0;
        //     document.getElementById(type).innerHTML = id;
        // }


        
        function showCommentNumber(id){
            var y = document.getElementById("commentcounter" + id).childElementCount;
            document.getElementById("numberOfComments").innerHTML = '(' + y + ')';
        }

        function messageUser(id){
            document.getElementById('id' + id).style.display='block';
            window.location.hash = "?user=" + id;
        }
       

        function messageUser1(id){
            document.getElementById('id1' + id).style.display='block';
            window.location.hash = "?user=" + id;
        }

        document.getElementById('petsForm').reset();

        function showPetInfo(id){
            document.getElementById('id' + id).style.display='block';
            window.location.hash = "?pet=" + id;
            // window.location.assign('?pet=' + id);
        }

        function showLikes(id){
            document.getElementById('pid' + id).style.display='block';
            window.location.hash = "?post=" + id;
        }

        function showGroupForm(id){
            document.getElementById(id).style.display = 'block';
        }


       

            function redirectProfile(id,folderpath){
                var path = folderpath + '/profiles.php?id=';
                    $.ajax({
                        beforeSend:function(){
                            window.location = path + id + '&redirect=1#?user=' + id;
                        },
                        type:"POST",
                        url:"profiles.php?id=" + id,
                        data: {id:id},
                        complete:function(){
                            // window.location = '/meetpuppiestest/profiles.php?id=' + id;
                            messageUser(id);
                        }
                    });

            };

            function updateChat(){
                var user1 = $("#sender").val();
                var user2 = $("#reciever").val();
                $.ajax({
                    type:"POST",
                    url:"function/updatechat.php",
                    data:{user1:user1,user2:user2},
                    success:function(){

                    }

                });
            }

       




var close = document.getElementsByClassName("closebtn");
var i;

// Loop through all close buttons
for (i = 0; i < close.length; i++) {
  // When someone clicks on a close button
  close[i].onclick = function(){

    // Get the parent of <span class="closebtn"> (<div class="alert">)
    var div = this.parentElement;

    // Set the opacity of div to 0 (transparent)
    div.style.opacity = "0";

    // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}

    if($('.alert').val() == ''){
        $('.alert').hide();
    }else{
        $('.alert').show();
    }

