$(document).ready(function(){
	$('#editPassword').click(function(){
		$('#editPasswordForm').show();
		$('#editNameForm').hide();
		$('#editProfilePictureForm').hide();
		$('#helpForm').hide();
	});
	$('#editProfilePicture').click(function(){
		$('#editPasswordForm').hide();
		$('#editNameForm').hide();
		$('#editProfilePictureForm').show();
		$('#helpForm').hide();
	});
	$('#editName').click(function(){
		$('#editPasswordForm').hide();
		$('#editNameForm').show();
		$('#helpForm').hide();
		$('#editProfilePictureForm').hide();
	});
	$('#help').click(function(){
		$('#editPasswordForm').hide();
		$('#editNameForm').hide();
		$('#helpForm').show();
		$('#editProfilePictureForm').hide();
	});

});