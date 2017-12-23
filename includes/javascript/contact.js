$(document).ready(function(){
	$("a.contact").click(function(event){
		event.preventDefault();
				
		$('body').prepend('<div id="overlay"></div>');
		$('.contactScreen').show();
	});
	
	$('.contactScreen > .close').click(function(event){
		event.preventDefault();
		
		$('#overlay').remove();
		$(this).parent().hide();
	});


	$('#contactForm').submit(function(){
		var name = $('input[name="name"]').val();
		var email = $('input[name="email"]').val();
		var atPosition = email.indexOf('@');
		var dotPosition= email.lastIndexOf('.'); 
		var error = 0;
		
		if (name == 'null' || name.length == 0){
			if (error == 0){
				$('input[name="name"]').focus();
			}
			error = error + 1;
		}
		
		if (email == 'null' || email.length == 0){
			if (error == 0){
				$('input[name="email"]').focus();
			}
			error = error + 1;
		}
		
		if (atPosition <1 || dotPosition<atPosition+2 || dotPosition+2>=email.length){
			if (error == 0){
				$('input[name="email"]').focus();
			}
			error = error + 1;
		}
		
		if (error == 0){
			return true;
		}else{
			$('div#error').show();
			alert("Please check that you have enter your name and email address correctly. \\n Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad e-bost yn gywir.");
			return false;
		}
		
	})
})