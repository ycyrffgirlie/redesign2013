$(document).ready(function() {
	
	$('#guestbookForm').submit(function(){
		var name = $('input[name="name"]').val();
		var comment = $('textarea[name="comment"]').val();
		var error = 0;
		
		if (name == 'null' || name.length == 0){
			if (error == 0){
				$('input[name="name"]').focus();
			}
			error = error + 1;
		}
		
		if (comment == 'null' || comment.length == 0){
			if (error == 0){
				$('textarea[name="comment"]').focus();
			}
			error = error + 1;
		}
		
		if (comment.length > 1000){
			if (error == 0){
				$('textarea[name="comment"]').focus();
			}
			error = error + 1;
		}
		
		if (error == 0){
			return true;
		}else{
			$('div#error').show();
			alert("Please check that you have enter your name and comment correctly. \\n Plis gwiriwch eich bod wedi rhoi eich enw a\'ch sylw yn gywir.");
			return false;
		}
		
	});
	
});