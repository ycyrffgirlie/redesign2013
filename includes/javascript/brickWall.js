$(document).ready(function() {
	
	var canvas = document.getElementById("brick_wall");
	var elemLeft = canvas.offsetLeft;
	var elemTop = canvas.offsetTop;
	var ctx = canvas.getContext("2d");
	var javaEnabled = navigator.javaEnabled();
	var colour = "#ff0000";
	var paint = "";
	var clickX = new Array();
	var clickY = new Array();
	var clickDrag = new Array();
	var clickColour = new Array();
	
	
	function addClick(x, y, dragging){
		clickX.push(x);
		clickY.push(y);
		clickDrag.push(dragging);
		clickColour.push(colour);
	}
	
	function init(){
		ctx.save();
		
		$(".clearBtn").show();
		$(".colour").show();
	
	}
	
	function redraw(){
		ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
		
		ctx.lineJoin = "round";
		ctx.lineWidth = 5;
		
		for (var i = 0; i < clickX.length; i++){
			ctx.beginPath();
			if (clickDrag[i] && i){
				ctx.moveTo(clickX[i - 1], clickY[i - 1]);
			}else{
				ctx.moveTo(clickX[i] - 1, clickY[i]);
			}
			ctx.lineTo(clickX[i], clickY[i]);
			ctx.closePath();
			ctx.strokeStyle = clickColour[i];
			ctx.stroke();
		}
	}
	
	if (javaEnabled === false){
		
		init();
	
		$(".clearBtn").click(function(){
			ctx.restore();
			ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
			clickX.length = 0;
			clickY.length = 0;
			clickDrag.length = 0;
			clickColour.length = 0;
			
			
		});
		
		$(".colour").change(function(){
			var selected = $(this).val();
			
			switch (selected){
			  case 'Red':
			    colour = "#ff0000";
			    break;
			  case 'Green':
			    colour = "#008000";
			    break;
			  case 'Black':
			    colour = "#000000";
			    break;
			  case 'Yellow':
			    colour = "#ffff00";
			    break;
			  case 'Blue':
			    colour = "#0000ff";
			    break;
			  case 'Cyan':
			    colour = "#00ffff";
			    break;
			  case 'Magenta':
			    colour = "#ff00ff";
			    break;
			  case 'Orange':
			    colour = "#ffa500";
			    break;
			}
			
		});
		
		$("#brick_wall").mousedown(function(event){
			var x = event.pageX - elemLeft;
			var y = event.pageY - elemTop;
			
			paint = true;
			addClick(x, y);
			redraw();
		
		});
		
		$("#brick_wall").mousemove(function(event){
			if (paint){
				var x = event.pageX - elemLeft;
				var y = event.pageY - elemTop;
				
				addClick(x, y, true);
				redraw();
			}
		});
	
		$("#brick_wall").mouseup(function(event){
			paint = false;
		});
		
		$("#brick_wall").mouseleave(function(event){
			paint = false;
		});
	
	}
	
});
