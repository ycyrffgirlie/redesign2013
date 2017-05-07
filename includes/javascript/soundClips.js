//@@author: Christine A Black
//yes this is my own work. All of it - mine. All mine. Errr I gues that includes bugs as well.

$(document).ready(function(){
	$("a.info").click(function(event){
		event.preventDefault();
	});
	$("a.info").hover(function(){
		$(this).children(".popup").show();
		//});
	});
	$("a.info").mouseleave(function(){
		$(this).children(".popup").hide();
	});
	$("a.music").click(function(event){
		var file = $(this).attr("href");
		var filemp3 = file +'mp3';
		var fileogg = file+'ogg';
		
		$("source.mp3").attr('src',filemp3);
		$("source.ogg").attr('src',fileogg);
		
		var aud = $("audio").get(0);
		
		aud.pause();
		aud.load();
		aud.play();
		
		event.preventDefault();
	});
});
