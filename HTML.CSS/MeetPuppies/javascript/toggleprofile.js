$(document).ready(function(){
	$('#addPet').click(function(){
		$('#mainProfile').toggle();
		if($('#mainProfile').css('display') == 'none'){
			$('#addPet').html('Return to posts');
		}else{
			$('#addPet').html('Add a Pet');
		}	

		$('#petsForm').toggle();
	});
});