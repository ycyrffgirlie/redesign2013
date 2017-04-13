<?php

class menu{
	
	/**/
	function build_band_section(){
		
		$output = "";
		$output .= '					<li>Band / Band
						<ul>
							<li><a href="/about.html">About / <span lang="cy">Am</span></a></li>
							<li><a href="/discography.html">Discography / <span lang="cy">Discograffi</span></a></li>
						</ul>
					</li>';
	
		return $output;
		
	}
	
	/**/
	function build_gallery_section(){
		
		$output = "";
		$output .= '					<li>Gallery / Galeri
						<ul>
							<li><a href="/sound_clips/index.html">Sound Clips / <span lang="cy">Swn FFeiliau</span></a></li>
							<li><a href="/Images/index.html">Pictures / <span lang="cy">LLuniau</span></a></li>
						</ul>
					</li>';
		
		return $output;
		
	}
	
	/**/
	function build_fan_section($class = "menu"){
		
		$output = "";
		$output .= '					<li>Fans / FFanau
						<ul>
							<li><a href="/games/index.html">Games / <span lang="cy">Gemau</span></a></li>
							<li><a href="/profiles/index.html">Profiles/ <span lang="cy">Proffeil</span></a></li>
						</ul>
					</li>';
		
		return $output;
		
	}
	
	/**/
	function build_me_section(){
		
		$output = "";
		$output .= '					<li>Me / Fi
						<ul>
							<li><a href="/thankyou.html">Thank You / <span lang="cy">Diolch</span></a></li>
							<li><a href="/about_me.html">About Me / <span lang="cy">Am Fi</span></a></li>
						</ul>
					</li>';
		
		return $output;
		
	}
	
	/**/
	function build_media_section(){
		
		$output = "";
		$output .= '					<li>Media / Cyfryngau
						<ul>
							<li><a href="/lyrics/index.html">Lyrics / <span lang="cy">Geiriau</span></a></li>
							<li><a href="/reviews/index.html">Reviews / <span lang="cy">Adolygiadau</span></a></li>
							<li><a href="/interviews/index.html">Interviews / <span lang="cy">Cyweliadau</span></a></li>
							<li><a href="/news/index.html">News Articles / <span lang="cy">Erthyglau Newyddion</span></a></li>
						</ul>
					</li>';
		
		return $output;
		
	}
	
	/**/
	function build_other_section(){
		
		$output = "";
		$output .= '					<li>Other / Arall
						<ul>
							<li><a href="/forsale.html">For Sale / <span lang="cy">Ar Wreth</span></a></li>
							<li><a href="/download.html">Downloads / <span lang="cy">Lawrlwythi</span></a></li>
							<!--<li><a href="/translation.html" rel="nofollow">Translation of song names and album titles</a></li>-->
						</ul>
					</li>';
		
		return $output;
		
	}
	
	/**/
	function build_web_section(){
		
		$output = "";
		$output .= '					<li>Web / Gwe
						<ul>
							<li><a href="/links.html">Links / <span lang="cy">Cysyllitiadau</span></a></li>
							<li><!--<a href="/newguestbook.html" rel="nofollow">--><a href="/guestbook.html" rel="nofollow">Guestbook / <span lang="cy">Gwestai LLyfr</span></a></li>
							<li><a href="/privacyandcookies.html">Privacy and Cookies Policy</a></li>
							<li><a href="/sitemap.html">Sitemap / <span lang="cy">Map o\'r safle</span></a></li>
						</ul>
					</li>';
		
		return $output;
		
	}
	
	/**/
	function display_menu($class =  "menu"){
		
		$output = "";
		$output .= '<!--I am in another file. Do you where I really am?-->

					<li><a href="/index.html">Home / <span lang="cy">Gartre</span></a></li>';
		$output .= $this ->build_band_section();
		$output .= $this ->build_gallery_section();
		$output .= $this ->build_media_section();
		$output .= $this ->build_fan_section($class);
		$output .= $this ->build_other_section();
		$output .= $this ->build_web_section();
		$output .= $this ->build_me_section();
		$output .= "<!--end being in another file. -->";
		
		
		return $output;
		
	}
	
	/**/
	/*function (){
		
		$output = "";
		$output .= "";
		
		return $output;
		
	}*/
	
}

?>