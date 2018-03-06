$(document).ready(function() {
	var allPagesheight = $(window).height();
	var allPageMinWidth = ($(window).width() / 100) *  2;
	var allPageMaxWidth = ($(window).width() / 100) *  29;
	
	$('#current-new-pages').sortable({
		placeholder: "highlight",
		connectWith: "#bin"
	});
	
	$('#bin').sortable({
		placeholder: "highlight-purple"
	});
	
	$('#recently-updated-pages').sortable({
		placeholder: "highlight",
		connectWith: "#current-new-pages"
	});
	
	$('#all-pages').sortable({
		placeholder: "highlight-purple",
		connectWith: "#current-new-pages"
	});
	
	$('#all-pages-container').resizable({
		minWidth: allPageMinWidth,
		maxWidth: allPageMaxWidth,
		minHeight: allPagesheight,
		//maxHeight: allPagesheight,
		animate: true,
		ghost: true,
		handles: "w"
	});
	
	$('#bin-button').click(function(event){
		event.preventDefault();
		
		$('#bin-container').show();
	});
	
	$('#bin-close').click(function(event){
		event.preventDefault();
		
		$('#bin-container').hide();
	});
	
	$('#save-button').click(function(event){
		event.preventDefault();
				
		$('body').prepend('<div id="backdrop"></div>');
		$('#save-dialog').show();
	});
	
	$('#save-confirm').click(function(event){
		event.preventDefault();
		
		var current_url = window.location.href;
		var current_order = new Object();
		var bin_items = new Object();
		var i = 0;
		var j = 0;
		var count = $('#current-new-pages li').length;
		
		$('li').each(function(){
			if ($(this).parent().attr("id") == "current-new-pages"){
				var filename =  $(this).children('.edit').children('.filename').text();
				var whatnewenglishH = $(this).children('.edit').children('.whatnewenglishH').val();
				var whatnewenglish = $(this).children('.edit').children('.whatnewenglish').val();
				var whatnewcymraegH = $(this).children('.edit').children('.whatnewcymraegH').val();
				var whatnewcymraeg = $(this).children('.edit').children('.whatnewcymraeg').val();
				var newsorderH = $(this).children('.edit').children('.newsorderH').val();
				var newsorder = count;
				var includedinnew = 1;
				
				current_order[i] = {
					"filename":filename, 
					"whatnewenglishH":whatnewenglishH,
					"whatnewenglish":whatnewenglish, 
					"whatnewcymraegH":whatnewcymraegH, 
					"whatnewcymraeg": whatnewcymraeg, 
					"newsorderH":newsorderH, 
					"newsorder":newsorder,
					"includedinnew" : includedinnew
				};
				
				i ++;
				count --;
			}
			
			if ($(this).parent().attr("id") == "bin"){
				if ($(this).children('.edit').children('.filename').length){
					var filename =  $(this).children('.edit').children('.filename').text();
					var newsorder = 0;
					var includedinnew = 0;
					
					bin_items[j] = {
						"filename" : filename,
						"newsorder" : newsorder,
						"includedinnew" : includedinnew
					};
					
					j ++;
				}
			}
		});
		
		$.ajax({
			type: "POST",
			//contentType: 'application/jspn; charset=utf-8',
			url: 'editWhatsNew.ajax.php',
			data: {
				'current_order' : current_order, 
				'bin' : bin_items
			},
			success: function(data){
				//var test = $.parseJSON(data);
				//console.log(test);
				$('#backdrop').remove();
				$('#save-dialog').hide();
				alert('Data successful saved.');
				window.location.href = current_url;
			}
			
		});
	});
	
	$('#save-cancel').click(function(event){
		event.preventDefault();
		
		$('#backdrop').remove();
		$('#save-dialog').hide();
		
	});
	
	$('.edit-button').click(function(event){
		event.preventDefault();
		
		$('body').prepend('<div id="backdrop"></div>');
		$(this).next('.edit').show();
	});
	
	$('.edit-save').click(function(event){
		var j = $(this).parents();
		event.preventDefault();
		
		$('#backdrop').remove();
		$(this).parents('.edit').hide();
	});
	
	$('.edit-cancel').click(function(event){
		event.preventDefault();
		
		if ($(this).parents('.edit').children('.whatnewenglish').val() != $(this).parents('.edit').children('.whatnewenglishH').val()){
			var whatnewenglish = $(this).parents('.edit').children('.whatnewenglishH').val();
			$(this).parents('.edit').children('.whatnewenglish').val(whatnewenglish);
		}
		
		if ($(this).parents('.edit').children('.whatnewcymraeg').val() != $(this).parents('.edit').children('.whatnewcymraegH').val()){
			var whatnewcymraeg = $(this).parents('.edit').children('.whatnewcymraegH').val();
			$(this).parents('.edit').children('.whatnewcymraeg').val(whatnewcymraeg);
		}
		
		$('#backdrop').remove();
		$(this).parents('.edit').hide();
	});

});