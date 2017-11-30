$(document).ready(function() {

	var lose = 'YOU ARE DRUNK! OH NO!<br /><br />Thank you for taking the Alcohol Test  ';
	var win = 'YOU ARE NOT DRUNK! GOOD!<br /><br />Thank you for taking the Alcohol Test ';
	var timer;

	function finish(message) {
		clearTimeout(timer);
		$("#output").html(message);
		$("#button1").hide();
		$("#button2").hide();
		$("#button3").hide();
	}

	function moveme(obj) {
		obj.style.pixelLeft += Math.random() * 250 - 150;
		obj.style.pixelTop += Math.random() * 250 - 150;
	}
	
	$("#button1").click(function(event){
		finish(win);
	});
	
	$("#button2").click(function(event){
		finish(win);
	});
	
	$("#button3").click(function(event){
		finish(win);
	});
	
	$("#button1").mouseover(function(){
		$(this).css('position', 'absolute'); 
		moveme(this);
	});
	
	$("#button2").mouseover(function(){
		$("#button1").show(); 
		$("#button3").show(); 
		$(this).css('position', 'absolute'); 
		moveme(this); 
		timer = setTimeout(finish, 60000, lose);
	});
	
	$("#button3").mouseover(function(){
		$(this).css('position', 'absolute'); 
		moveme(this)
	});
}); 
 