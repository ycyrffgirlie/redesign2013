$('document').ready(function(){
	$('input[name="mess"]').val("");
	$('input[name="mess"]').val("");
	
	function total(){
		var score=0;
		var level="% obsessed with Y Cyrff";
		var result=0;
		var statement="You may become obsessed";
		
		if ($('input[name="a"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="b"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="c"]').is(":checked")){
			score=score+2;
		}
		if ($('input[name="d"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="e"]').is(":checked")) {
			score++;
		}
		if ($('input[name="f"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="g"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="h"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="i"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="j"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="k"]').is(":checked")){
			score++;
		}
		if ($('input[name="l"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="m"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="n"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="o"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="p"]').is(":checked")){ 
			score++;
		}
		if ($('input[name="q"]').is(":checked")){
			score=score+2;
		}
		if ($('input[name="r"]').is(":checked")){ 
			score=score+2;
		}
		
		score=Math.round((score/18)*100);
		
		if (score<17){
			statement="You are NOT obsessed";
		}
		if (score>74){ 
			statement="Wow, you are obsessed!";
		}
		if (score>100){
			statement="Please get help";
		}
		
		result=score+level;
		$('input[name="mess"]').val(result);
		$('input[name="state"]').val(statement);
	}
	
	$("#obsessed").submit(function(){
		total();
		return false;
	});

});