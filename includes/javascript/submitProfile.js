$('document').ready(function(){
	$('input[name="favesong"]').keypress(function(){
		var textEnter = $(this).val();
		
		if (textEnter){
		
		}
	});
	
	var albums = [
		"Dan y Cownter",
		"Y Testament Newydd",
		"Yr Atgyfodi",
		"Awdl o Anobaith",
		"LLawenydd Heb DDiwedd",
		"Mae DDoe Yn DDoe",
		"Damwain Mewn FFatri Cyllyll a FFyrc",
		"Atalnod LLawn"
	];
	
	$('input[name="favesong"]').autocomplete({
		source: "profiles.ajax.php",
		minLemgth: 2
	});
	
	$('input[name="favealbum"]').autocomplete({
		source: albums
	});
	
	$('div#error').hide();
	
	$('#profileForm').submit(function(){
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
});