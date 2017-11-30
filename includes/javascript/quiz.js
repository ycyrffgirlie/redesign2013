$(document).ready(function() {
	var ans = new Array;
	var done = new Array;
	var yourAns = new Array;
	var explainAnswer = new Array;

	var score = 0;
	ans[1] = "a";
	ans[2] = "c";
	ans[3] = "b";
	ans[4] = "c";
	ans[5] = "a";
	ans[6] = "d";


	explainAnswer[1]="Y Cyrff were from LLanrwst.";
	explainAnswer[2]="Mark Roberts sang lead vocals.";
	explainAnswer[3]="They sang in Welsh.";
	explainAnswer[4]="The full title is MaeDDoe yn DDoe which translates asYesterday is Yesterday.";
	explainAnswer[5]="They split up in 1992.";
	explainAnswer[6]="Mark Roberts and Paul Jones found fame with Catatonia.";

	function Engine(question, answer) {
		yourAns[question]=answer;
	}

	function Score(){
		var answerText = "How did you do?\n------------------------------------\n";
		for(i=1;i<=6;i++){
			answerText=answerText+"\nQuestion :"+i+"\n";
			if(ans[i]!=yourAns[i]){
				answerText=answerText+"The correct answer was "+ans[i]+"\n"+explainAnswer[i]+"\n";
			}else{
				answerText=answerText+"Correct! \n";
				score++;
			}
		}

		answerText=answerText+"\n\nYour total score is : "+score+"\n";

		//now score the user
		answerText=answerText+"\nComment : ";
		if(score<=0){
			answerText=answerText+"You need to learn some more";
		}
		if(score>=1 && score <=2){
			answerText=answerText+"bit more practice";
		}
		if(score>=3 && score <=3){
			answerText=answerText+"doing ok";
		}
		if(score>4){
			answerText=answerText+"You know your stuff then!";
		}
		
		alert(answerText);

	}

	$('input[type="radio"][name="q1"]').click(function(event){
		Engine(1, $('input[type="radio"][name="q1"]:checked').val());
	});
	
	$('input[type="radio"][name="q2"]').click(function(event){
		Engine(2, $('input[type="radio"][name="q2"]:checked').val());
	});
	
	$('input[type="radio"][name="q3"]').click(function(event){
		Engine(3, $('input[type="radio"][name="q3"]:checked').val());
	});
	
	$('input[type="radio"][name="q4"]').click(function(event){
		Engine(4, $('input[type="radio"][name="q4"]:checked').val());
	});
	
	$('input[type="radio"][name="q5"]').click(function(event){
		Engine(5, $('input[type="radio"][name="q5"]:checked').val());
	});
	
	$('input[type="radio"][name="q6"]').click(function(event){
		Engine(6, $('input[type="radio"][name="q6"]:checked').val());
	});
	
	$("#quiz").submit(function(){
		Score();
		return false;
	});

});
