var state = "";
$(document).ready(function(){
	$('a[class*=browser]').ready(function(){
		$('div[class*=zippy-content]').hide();
		/*$('img[class*=browser]').attr('src','/Images/site/plus.jpg');
		$('img[class*=browser]').attr('height','15');
		$('img[class*=browser]').attr('width','15');*/
	});
	$('a.browser-chrome1').click(function(){
		$('div.zippy-content-chrome1').slideToggle(500,"linear");
		/*if ($('div.zippy-content-chrome1').is(':hidden')) {
					var state = "closed";
					$('img[class=browser-chrome1]').attr('src','/Images/site/plus.jpg');
					$('img[class=browser-chrome1]').attr('height','15');
					$('img[class=browser-chrome1]').attr('width','15');
				} else {
					var state = "open";
					$('img[class=browser-chrome1]').attr('src','/Images/site/minus.jpg');
					$('img[class=browser-chrome1]').attr('height','15');
					$('img[class=browser-chrome1]').attr('width','15');
				}*/
	});
	$('a.browser-ie1').click(function(){
		$('div.zippy-content-ie1').slideToggle(500,"linear");
		/*if ($('div.zippy-content-ie1').is(':hidden')) {
					var state = "closed";
					$('img[class=browser-ie1]').attr('src','/Images/site/plus.jpg');
					$('img[class=browser-ie1]').attr('height','15');
					$('img[class=browser-ie1]').attr('width','15');
				} else {
					var state = "open";
					$('img[class=browser-ie1]').attr('src','/Images/site/minus.jpg');
					$('img[class=browser-ie1]').attr('height','15');
					$('img[class=browser-ie1]').attr('width','15');
		0		}*/
	});
	$('a.browser-firefox1').click(function(){
		$('div.zippy-content-firefox1').slideToggle(500,"linear");
	});
	$('a.browser-opera1').click(function(){
		$('div.zippy-content-opera1').slideToggle(500,"linear");
	});
	$('a.browser-safari1').click(function(){
		$('div.zippy-content-safari1').slideToggle(500,"linear");
	});
	$('a.browser-konqueror1').click(function(){
		$('div.zippy-content-konqueror1').slideToggle(500,"linear");
	});
	$('a.browser-chrome2').click(function(){
		$('div.zippy-content-chrome2').slideToggle(500,"linear");
	});
	$('a.browser-ie2').click(function(){
		$('div.zippy-content-ie2').slideToggle(500,"linear");
	});
	$('a.browser-firefox2').click(function(){
		$('div.zippy-content-firefox2').slideToggle(500,"linear");
	});
	$('a.browser-opera2').click(function(){
		$('div.zippy-content-opera2').slideToggle(500,"linear");
	});
	$('a.browser-safari2').click(function(){
		$('div.zippy-content-safari2').slideToggle(500,"linear");
	});
	$('a.browser-konqueror2').click(function(){
		$('div.zippy-content-konqueror2').slideToggle(500,"linear");
	});
	/*if (state == close){
	$('li[class=browser]').css('list-style-image','/Images/site/plus.jpg');
		
	
	}
	else {
	
	}*/
});