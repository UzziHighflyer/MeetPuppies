	// $(document).ready(function(){
	// 	// $('#likeForm').on('submit',function(e){
	// 	// 	e.preventDefault();
	// 	// 	$.ajax({
	// 	// 		type:"POST",
	// 	// 		url:'function/likes.php',
	// 	// 		data:$('#likeForm').serialize(),
	// 	// 		success: function(response){
	// 	// 			if(response == 'lajkovano'){
	// 	// 				$('#likeForm').hide();
	// 	// 				$('#unLikeForm').show();
	// 	// 			}
	// 	// 		}
	// 	// 	});
	// 	// });
	// 	// $('#unLikeForm').on('submit',function(e){
	// 	// 	e.preventDefault();
	// 	// 	$.ajax({
	// 	// 		type:"POST",
	// 	// 		url:'function/likes.php',
	// 	// 		data:$('#unLikeForm').serialize(),
	// 	// 		success: function(){
	// 	// 			if(response == 'odlajkovano'){
	// 	// 				$('#likeForm').show();
	// 	// 				$('#unLikeForm').hide();
	// 	// 			}
	// 	// 		}
	// 	// 	});
	// 	// });
	// 	$('.preventSubmit').submit(function(e){
	// 		e.preventDefault();
	// 		var currentForm = this;
	// 		var id = this.id;
	// 		var check = id.split('m');
			
	// 		if(check[0] == 'likeFor'){				
	// 			$.ajax({
	// 				type:"POST",
	// 				url:'function/likes.php',
	// 				data:$('#' + id).serialize(),
	// 				success: function(){
	// 					$('#' + id).hide();
	// 					$('#unLikeForm' + check[1]).show();

	// 				},
	// 				error: function(){
	// 					console.log('kokokookko')
	// 				}
	// 			});
	// 		}else{
	// 			$.ajax({
	// 				type:"POST",
	// 				url:'function/likes.php',
	// 				data:$('#' + id).serialize(),
	// 				success: function(data){
	// 					$('#likeForm' + check[1]).show();
	// 					$('#' + id).hide();
	// 					console.log(data);

	// 				}
	// 			});
	// 		}

	// 	});

	// 	$('.preventSubmit1').submit(function(e){
	// 		e.preventDefault();
	// 		var currentForm = this;
	// 		var id = this.id;
	// 		var check = id.split('m');
			
	// 		if(check[0] == 'likeFor'){				
	// 			$.ajax({
	// 				type:"POST",
	// 				url:'function/likes.php',
	// 				data:$('#' + id).serialize(),
	// 				success: function(){
	// 					$('#' + id).hide();
	// 					$('#unLikeForm' + check[1]).show();

	// 				},
	// 				error: function(){
	// 					console.log('kokokookko')
	// 				}
	// 			});
	// 		}else{
	// 			$.ajax({
	// 				type:"POST",
	// 				url:'function/likes.php',
	// 				data:$('#' + id).serialize(),
	// 				success: function(){
	// 					$('#likeForm' + check[1]).show();
	// 					$('#' + id).hide();

	// 				}
	// 			});
	// 		}

	// 	});

	// });