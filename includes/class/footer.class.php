<?php
/*@Author; Christine A. Black
@Version:0.1
@todo: 
Version 0.1 - Added the footer class to the footer..*/

class footer{
	

	/*builds the bottom of footer.*/
	function build_footer_bottom(){
		
		$output  =  '';
		
		$output  .=  '
		</footer>

<!--</div>-->
	';	
		return $output; 

	}
	
	/*builds the top of footer.*/
	function build_footer_top(){
	
		$output  =  '';
		
	$output  =  '
			<footer>
			
				<div class="footerLeft">
		';
	
		return $output; 

	}
	
	/*builds the right of footer.*/
	function footer_right(){
		
		$output  =  '';
		
		$output  =  '
				</div>
				
				<div class="footerRight">
			';
		
		$output  .=  $this ->site_search();
		$output  .=  '
				</div>
				
				<div style="clear:both;"></div>		
				';
		
		return $output; 

	}
	
	/*builds Googlr ads*/
	function google_ads(){
		
		$output  =  '';
		
		$output  =  '
					<br />
					<script type="text/javascript"><!--
					google_ad_client = "ca-pub-1700322885253994";
					/* Ad 1 */
					google_ad_slot = "4964110045";
					google_ad_width = 468;
					google_ad_height = 60;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
						
					<a href="http://tracking.opienetwork.com/aff_c?offer_id=20&aff_id=5600&file_id=313" target="_blank"><img src="http://media.go2speed.org/brand/files/opienetwork/20/hp-88x31-green.gif" width="88" height="31" border="0" /></a><img src="http://tracking.opienetwork.com/aff_i?offer_id=20&aff_id=5600&file_id=313" width="1" height="1">
		';
		
		return $output; 

	}
	
	
	/*builds the live welcome message with ip addrewss.*/
	function live_message($ipAddress = "127.0.0.1"){
		
		$output  =  '';
		
		$output  .=  '
				<p>
					Welcome '.$ipAddress.', please remember that this is live. So please don\'t fuck it up. 
					<br />
		';
		
		return $output; 

	}
	
	/*builds the Member of The Internet Defense League badge.*/
	function member_badge(){
		
		$output  =  '';
		
		$output  .=  '
					<a href="http://internetdefenseleague.org"><img src="http://internetdefenseleague.org/images/badges/final/footer_badge.png" alt="Member of The Internet Defense League" /></a>
		';
		
		return $output; 

	}
	
	
	/*builds the live welcome message with user.*/
	function not_live_message($user = "Christine"){
		
		$output  =  '';
		
		$output  .=  '
				<p>
					Welcome '.$user.', this is not live. 
					<br />
		';
		
		return $output; 

	}
	
	/*builds the site search..*/
	function site_search(){
		
		$output  =  '';
		
		$output  =  '
					<form accept-charset="UTF-8" action="http://www.jrank.org/api/search/v2" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="?" /></div>
						<fieldset style="border: 1px solid rgb(175, 175, 175); display: inline;">
							<legend>
								<a href="http://www.jrank.org/" style="font-size: 10pt; font-family: Arial, sans-serif;">
									Site Search
								</a>
							</legend>
							<a href="http://www.jrank.org/">
								<img alt="Site Search" 
								src="http://www.jrank.org/images/jrank_88_31-fs8.png" 
								style="border: none; vertical-align: middle;" title="Site Search" />
							</a>
							<input id="key" name="key" type="hidden" value="827b2c24d923ca553b508bc1160538c4c164a2c4" />
							<input name="ie_utf8_fix" type="hidden" value="?" />
							<input id="q" name="q" style="display: inline; vertical-align: middle;" type="text" value="" />
							<input name="commit" style="display: inline; vertical-align: middle;" type="submit" value="Search" />
						</fieldset>
					</form>
		';
		
		return $output; 

	}
	
	/*builds the spacung between the content and tthe footer.*/
	function spacing(){
		
		$output  =  '';
		
		$output  .=  '

			<div class="clear"></div>
			<div class="verticalspace">&nbsp;</div>
			<div class="clear"></div>
		';

		return $output; 

	}
	
	/**/
	/*function (){
		
		$output  =  '';
		
		return $output; 

	}*/
}

?>