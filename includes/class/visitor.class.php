<?php
/*@Author; Christine A. Black
@Version:0.8
@todo: add the e-mail class, 
remove comment it out code, comment the rest of the rest of the code, set params to 
default values.

Version 0.8 - More debugging.
Version 0.7 - Re-alight code of output.
Version 0.6 - Debug
Version 0.5 - Added the e-mail methods.
Version 0.4 - Added the get_filename method
Version 0.3 - Sorted out the visitor_table method
Version 0.2 - Added debug, domainName_check, error, initialise_session_vars, ip_address_check 
methods.
Version 0.1 - Added the visitor class to the footer*/


class visitor{
	
	//protected 
	public $os, $browserName, $browserVersion, $domainName, 
	$ipAddress, $refererPage, $requestPage, $user, $filename,
	$phpSelf;

	/**/
	function alt_browser(){
		$output  =  '';
		
		$browsernames = array('IE' ,'MSIE', 'Firefox', 'Chrome','Opera', 'Safari');
		
		if ($this->os == 'Linux'){
		
			$IELink ='';
		
		}else{
		
			$IELink ='http://windows.microsoft.com/en-GB/internet-explorer/products/ie/home';
			
		}
		
		$browser = array('IE' => array("link" => $IELink, "image" => 'ie.gif', "width" => 31, "height" =>30), 
			'MSIE'=> array("link" => $IELink, "image" => 'ie.gif' , "width" => 31,  "height" =>30), 
			'Firefox' => array("link" => 'http://www.mozilla.org/', "image" => 'firefox.gif', "width" =>31, "height" =>30),
			'Chrome' => array("link" => 'http://www.google.com/chrome/', "image" => 'chrome.gif', "width" =>31, "height" =>30),
			'Opera' => array("link" => 'http://www.opera.com/', "image" => 'opera.gif', "width" =>28, "height" =>30),
			'Safari' => array("link" => 'http://www.apple.com/safari/', "image" => 'safari.gif', "width" =>28, "height" =>30)
			);
		
		foreach ($browsernames as $browsername){
		
			if ($this->browserName  == $browsername){
			
				//if ($this->os != 'Linux' && $this->browserName != 'Safari'){
				
	$output  .=  '<div class="supportedBrowser">
		<div class="text">
			<p>
			
			</p>
		</div>
		
		
		<div class="image">
			<a href="'.$browser [$browsername]["link"].'" target="_blank">
				<img src="/images/site/'.$browser [$browsername]["image"].'" 
				width="'.$browser [$browsername]["width"].' px" height="'.$browser [$browsername]["height"].'px"
				alt="'.$browsername.'" />
			</a>
		</div>
	</div>
	
	<div class="clear"></div>
	
	';
				
				//}
			}
		}
		
		if ($this->os !=  'Windows 98' && $this->os != 'Windows 95'  && 
		$this->os !=  'Windows 2000' && $this->os != 'Windows ME'){
		
		$output .= '<p>Alternative Browsers  / Porwyr arall:</p>
		
		<div class="supportedBrowersContainer">
		
		';
		
			foreach ($browsernames as $browsername){
			
				if ($this->browserName  != $browsername  //&&
				//($this ->browserName != 'IE'  && $browsername !='MSIE') &&
				
				){
			
					if ($browsername != 'MSIE'){
						//if ($browsername !='IE' &&$this ->browserName != 'MSIE' ){
				
						$output .= '<div class="supportedBrowser">
					<div class="text">
						<p>
						
						';
				
							if ($this->os == 'Linux' && $browsername == 'IE'){
			
								$output .= 'If you must destroy 
							a beautiful OS with I.E then';
							}
					
						$output .= '</p>
			</div>
			
				';
					
				$output .=  '<div class="image">
				<a href="'.$browser [$browsername]["link"].'" target="_blank">
				<img src="/images/site/'.$browser [$browsername]["image"].'" 
				width="'.$browser [$browsername]["width"].' px" height="'.$browser [$browsername]["height"].' px"
				alt="'.$browsername.'" />
				</a>
				
				';
					
				$output .= '</div>
			</div>
			
			';
					
						//}
					}
			
				}
				
			
			}
		
			$output .= '</div>
			
			';
			
			if (($this->os == 'Windows Vista' || $this->os == 'Windows XP' || 
			$this->os == 'Windows 7') && $this->browserName == 'IE'){
			
				$output .= '<p style="">Please note: If you are using IE under Wine on a 
				Linux - the script will detect Windows instead of Linux.
				</p>';
			
			}
		
		}
		
		return $output ; 
	}
	
	/*For debugging*/
	function debug($debug, $os, $browser){
	
		switch($debug){
		  case 'true':
		
			$sessionVars =$this ->initialise_session_vars($debug, $os, $browser);
			
			break;

		  default:
		
			$sessionVars = $this ->initialise_session_vars($debug, $os, $browser);
	
			break;
		
		}
	
		return $_SESSION["os"];
		return $_SESSION["browsername"];
		return $_SESSION["browsernversion"];
		return $_SESSION["domainname"];
		return $_SESSION["ip_address"];
		return $_SESSION["referer_page"];
		return $_SESSION["request_page"];
		return $_SESSION["user"];
		return $_SESSION["filename"]; 
		return $_SESSION["php_self"];
	
	}
	
	/**/
	function display_message(){
	
		$output = $this ->get_os_message().$this -> alt_browser();
		return $output ; 
	}
	
	/*Check if interal domain name  wheter or not it's live or development.*/
	function domainName_check($domainName){
	
		$domainnames = array('christine.ycyrffgroupie.co.uk',
			'dev.ycyrffgroupie.co.uk',
			'llwybrllaethog.ycyrffgroupie.co.uk',
			'admin.ycyrffgroupie.co.uk'
			,'redesign2013.ycyrffgroupie.co.uk'
			,'christine.linux.ycyrffgroupie.co.uk'
			,'redesign2013.linux.ycyrffgroupie.co.uk'
			);
	
		if (in_array($domainName, $domainnames)){
		
			return true;
		
		}else{
		
			return false;
		
		}
	
	}
	
	/**/
	function get_browser_info($os, $browserName, $browserVersion) {
	
		$this->os = $os;
		$this->browserName =  $browserName;
		$this->browserVersion = $browserVersion;
		
	}
	
	/**/
	function get_visitor_info($domainName, $ipAddress, $refererPage, $requestPage, $user, 
	$filename, $phpSelf ) {
	
		$this->domainName = $domainName;
		$this->ipAddress = $ipAddress;
		$this->refererPage = $refererPage;
		$this->requestPage = $requestPage;
		$this->user = $user;
		$this->filename = $filename;
		$this->phpSelf = $phpSelf;
	}
	
	/**/
	function get_os_message(){
	
		switch($this->os){
		  case 'Linux';
			 
			if ($this->browserName == 'IE'){
				$message = '<p>Microsoft has stop supporting '.$this->browserName.' 
				on '.$this->os.'. 
				<br />
				Please use alternative browsers.</p>
				
				<p>
				Nid '.$this->browserName.' hwn yn cefnogi '.$this->os.'. 
				<br />
				Plis defnyddiwch porwr arall.
				</p>
				
				';
			}elseif ($this->browserName == 'Safari') {
			
				$message  = '<p>How did you get  '.$this->browserName.' to run on 
				'.$this->os.'? Apple doesn\'t support. I thought the saying is "Can I get Linux 
				run on this?" not "will Safari run on Linux? " Seeing you are a smart arse 
				I am not getting you the link for Safari for Linux.</p>';
			
			}else{
				$message =  '	<p>
		This site doesn\'t support your version of '.$this->browserName.'. 
		Please update your browser.
		<br />
		Please check your distros lastest repository branch first.</p>
		<p>Nid we safle hwn yn cefnogi eich fersiwn o '.$this->browserName.'. 
		<br />
		Diweddarwch eich porwr.</p>
				
				';
			}
			
		   break;
		   
		   case 'Mac';
			 
			if ($this->browserName == 'IE'){
				$message = '<p>Microsoft has stop supporting '.$this->browserName.' 
				on '.$this->os.'. 
				<br />
				Please use alternative browsers.
				</p>
				
				<p>
				Nid '.$this->browserName.' hwn yn cefnogi '.$this->os.'. 
				<br />
				Plis defnyddiwch porwr arall.
				</p>
				
				';
			}else{
				$message =  '<p>This site doesn\'t support your version of '.$this->browserName.'. 
				<br />
				Please update your browser.</p>
				<p>Nid we safle hwn yn cefnogi eich fersiwn o '.$this->browserName.'. 
				<br />
				Diweddarwch eich porwr.</p>
				
				';
			}
			
		   break;
		   
		   case 'Windows 95';
		   case 'Windows 98';
		   case 'Windows 2000';
		   case 'Windows ME';
			 
			$message =  '<p>This site doesn\'t support your version of '.$this->browserName.'.  
			<br />
			Please update your browser.</p>
			<p> '.$this->browserName.'  doesn\'t support 
		Windows Me, Windows 2000, Windows 98, Windows 95.
		<!--If you need to use a version of Windows 
		that pre-dates Windows Xp then chosse from the alternative browsers.--></p>
	<p>
		Nid we safle hwn yn cefnogi eich fersiwn o '.$this->browserName.'. 
		<br />
		Diweddarwch eich porwr.
	</p>
	<p>
		Nid '.$this->browserName.' hwn yn cefnogi 
		Windows Me, Windows 2000, Windows 98, Windows 95.
	</p>
			';
			
		   break;
		   
		    case 'Windows Vista';
		    case 'Windows 7';
		    case 'Windows XP';
			 
			$message =  '	<p>
		This site doesn\'t support your version of '.$this->browserName.'. 
		<br />
		Please update your browser.
	</p>
	
	<p>
		Nid we safle hwn yn cefnogi eich fersiwn o '.$this->browserName.'. 
		<br />
		Diweddarwch eich porwr.
	</p>
	
		';
			
		   break;
		   
		  default:
			
			$message =  '<p>This site doesn\'t support your version of '.$this->browserName.'. 
			<br />
			Please update your browser.
			</p>
			<p>Nid we safle hwn yn cefnogi eich fersiwn o '.$this->browserName.'. 
			<br />
			Diweddarwch eich porwr.</p>
				
			';
		
		  break;
		}
		
		return $message;
	}
	
	/*Set the session.*/
	function initialise_session_vars($debug, $os, $browser){

		switch($debug){
		  case 'true':

			if ($os){
				
				$_SESSION["os"] = $os;
				$_SESSION["browsername"] = $browser;
		
				if ($browser == 'Firefox'){
					
					//$_SESSION["browsernversion"] = 0;
					$_SESSION["browsernversion"] = 3;
					
				}elseif  ($browser == 'Chrome'){
					
					//$_SESSION["browsernversion"] = 0;
					$_SESSION["browsernversion"] = 13.0;
					
				}elseif  ($browser= 'IE'){
				
					//$_SESSION["browsernversion"] = 0;
					$_SESSION["browsernversion"] = 6;
					
				}elseif  ($browser == 'Opera'){
					
					//$_SESSION["browsernversion"] = 0;
					$_SESSION["browsernversion"] = 9;
					
				}elseif  ($browser == 'Safari'){
					
					//$_SESSION["browsernversion"] = 0;
					$_SESSION["browsernversion"] = 5.0;
					
				}else{
				
					$_SESSION["os"] = 'unknown';
					$_SESSION["browsername"] = 'unknown';
					$_SESSION["browsernversion"] = 0;	
				
				}
		
			}else{
			
				$_SESSION["os"] = 'Linux';
				$_SESSION["browsername"] = 'Firefox';
				$_SESSION["browsernversion"] = 9;	
		
			}
	
			break;

		  default:
		
			if ($os){
			
				$_SESSION["os"] = $os;
				$_SESSION["browsername"] = $browsername;
				$_SESSION["browsernversion"] = $browsernversion;
		
			}else{
		
				$_SESSION["os"] = 'Linux';
				$_SESSION["browsername"] = 'Firefox';
				$_SESSION["browsernversion"] = 9;
		
			}

			break;

		}
	
		$_SESSION["domainname"] = $_SERVER["HTTP_HOST"];
		$_SESSION["ip_address"]  = $_SERVER["REMOTE_ADDR"];
		$_SESSION["referer_page"]  = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]: 'none';
		$_SESSION["request_page"]  = $_SERVER["REQUEST_URI"];
		$_SESSION["user"] = isset($_SERVER["PHP_AUTH_USER"])?$_SERVER["PHP_AUTH_USER"]: 'none';
		$_SESSION["filename"] = $_SERVER["SCRIPT_FILENAME"];
		$_SESSION["php_self"] = $_SERVER["PHP_SELF"];
		
		return $_SESSION["os"];
		return $_SESSION["browsername"];
		return $_SESSION["browsernversion"]; 
		return $_SESSION["domainname"];
		return $_SESSION["ip_address"];
		return $_SESSION["referer_page"];
		return $_SESSION["request_page"];
		return $_SESSION["user"];
		return $_SESSION["filename"]; 
		return $_SESSION["php_self"];
	
	}

	/*Check the IP address*/
	function ip_address_check($ipAddress){
	
	
		if ($ipAddress  == '188.223.77.182'){
		
			return true;
		
		}else{
		
			return false;
		
		}
	
	
	}
	
	/**/
	function os_check() {
		
		//$output = '<p>'.$browserInfo.'</p>';
		
		/*switch($this->os){
		   case 'linux';*/
			
			switch($this->browserName){
			   case  'Firefox';
				
				$supportedBrowserVersion = 5;
				break;
				
			   case  'Chrome';
				
				$supportedBrowserVersion= 15.0;
				break;
				
			   case  'IE';
			   case 'MSIE';
				
				$supportedBrowserVersion = 7;
				break;
				
			   case  'Opera';
				
				$supportedBrowserVersion = 10;
				break;
				
			   case  'Safari';
				
				$supportedBrowserVersion = 5.2;
				break; 
			 
			 default:
			
				$supportedBrowserVersion = 0;
				break; 
				
			}
			
			$browserCheck = $this -> browser_check($supportedBrowserVersion);
			
		   /*break;
		   
		  default:
		  
		  break;
		}*/
		
		if ($browserCheck  == 0){
			$output = $this -> visitor_table();
		}elseif ($browserCheck  == 1){
			
			$output = $this -> display_message();
			$updateTable = $this -> visitor_table();
			
		}else{
			$updateTable = $this -> visitor_table();
		}
		
		if (isset($output)){
			echo $output ; 
		}
	}
	
	/**/
	function  browser_check($supportedBrowserVersion){
		
		if ($this->browserVersion == 0){
			$browserCheck = 0;
		}elseif ($this->browserVersion <= $supportedBrowserVersion){
			$browserCheck = 1;
		}else{
			$browserCheck = 2;
		}
		
		return  $browserCheck;
	}
		
	/**/
	function visitor_table(){
	
	require("/var/www/websites/redesign2013/includes/connection.php");

		$sql = "INSERT INTO visitor(
						os, browser_name, browser_version,
						domainName, ipAddress, refererPage,
						requestPage, user, filename,
						phpSelf 
						)
		VALUES ('".$this->os ."' , '".$this->browserName."' , '".$this->browserVersion."'
		, '".$this->domainName."' ,  '".$this->ipAddress."', '".$this->refererPage."' 
		, '".$this->requestPage."' ,  '".$this->user."', '".$this->filename."' 
		, '".$this->phpSelf 
		."');";
		
		try{
		
			$query = $database ->prepare($sql);
			$query ->execute();
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		//return $sql ;
	}
	
	/**/
	function get_visitor_details($os, $browserName, $browserVersion,
	$domainName, $ipAddress, $refererPage, $requestPage, $user, $filename, $phpSelf ){
	
		$browserInfo = $this -> get_browser_info($os, $browserName, $browserVersion);
		$visitorInfo = $this -> get_visitor_info($domainName, $ipAddress, $refererPage, 
		$requestPage, $user, $filename, $phpSelf);
		
	}
	
	/**/
	function visitor_display($message){
	
		$output = $message."
					Script Name: ".$this->filename."
					<br />
					Php_self: ".$this->phpSelf."
					<br>
					Your Os: ".$this->os  ." and you are using: ".$this->browserName ." ".$this->browserVersion.". 
					<br />
					Your ISP is: ".$this->ipAddress.". 
					<br />
					You have come from: ".$this->refererPage.".
					<br />
					This footer is for your information.
				</p>";
		
		echo $output;
		
	}
	
	
	/**/
	function get_filename(){
	
		$filename = $_SERVER['SCRIPT_FILENAME'];
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			$filename = preg_replace('%/var/www/websites/redesign2013%', '' , $filename);
		
		}else{
			
			$filename = preg_replace('%/home/ycyrf718/public_html%', '' , $filename);
			
			if (preg_match('%christine%', $filename)){
				$filename = preg_replace('%/christine%','', $filename);
			}elseif(preg_match('%dev%',$filename)){
				$filename = preg_replace('%/dev%','', $filename);
			}elseif (preg_match('%/redesign2013%', $filename)){
				$filename = preg_replace('%/redesign2013%', '', $filename);
			}
		}
		
		return $filename;
		
	}
	
	/**/
	function email(){
	
		$to = 'ycyrffgroupie@gmail.com';
		$subject = 'Reports';
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
		$headers ='MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: multipart/alternative; boundary='.$mime_boundary. "\r\n";
		$headers .='From:  "Webmistress" <webmistress@ycyrffgroupie.co.uk>'. "\r\n";	
		
		$htmlEmail = $this ->build_email_html();
		$txtEmail = $this ->build_email_txt();
		
		//$this ->cleanVisitorTable();
		
		$message = "This is a multi-part message in MIME format.\r\n\r\n" .
		'--'.$mime_boundary."\r\n".
		'Content-Type: text/plain; charset="utf-8"'."\r\n".
		'Content-Transfer-Encoding:7-bit'."\r\n\r\n".$txtEmail."\r\n".
		"--{$mime_boundary}\r\n" .
		"Content-Type:text/html; charset=\"utf-8\"\r\n" .
		"Content-Transfer-Encoding: 7bit\r\n\r\n" .
		$htmlEmail."\r\n";
		
		//if (mail($to,$subject,$message, $headers)){
			
			//$output = 'Email was sent.';
			
		//}else{
			
			$output = "Email wasn't sent.";
			
		//}
		
		
		$filename = 'visitorsEmail.txt';
		
		try {
			$file = fopen('/var/www/websites/redesign2013/logs/'.$filename,'c');
	
			if ($file){
				fwrite($file, $message);
			}else{
				
				throw new Exception("Couldn't open file.");
				
			}
	
		}catch(Exception $error){
			
			echo 'Error: '.$error ->getMessage(),"\n";
			print_r($error->getTrace());
			echo 'Exception Code:'.$error->getCode()."\n";
			echo 'Line :'.$error->getLine().' - File:'.$error->getFile()."\n";
		}
		
		//echo $message;
		
		return $output ;
		
		
	}
	
	/**/
	function get_list_of_visitor_html(){
	
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$output  =  '';
		
		$sql ="SELECT * FROM visitor";
		
		try{
			$query = $database->prepare($sql);
			$query ->execute();
			
			$output  .= $this ->build_html_table_top();
			
			while($visitorsDetails = $query ->fetch()){
		
				//print_r($visitorsDetails);
				
				$output  .= $this ->build_visitor_table_row_html($visitorsDetails["dateVisited"],
				$visitorsDetails["os"], $visitorsDetails["browser_name"],
				$visitorsDetails["browser_version"], $visitorsDetails["domainName"],
				$visitorsDetails["ipAddress"], $visitorsDetails["refererPage"],
				$visitorsDetails["requestPage"], $visitorsDetails["user"],
				$visitorsDetails["filename"], $visitorsDetails["phpSelf"]);
			}
			
			$output  .= $this ->build_html_table_bottom();
			
			//die();
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		
		return $output;
		
	}
	
	/**/
	function build_visitor_table_row_html($dateVisited,$os, $browserName, $browserVersion,
	$domainName, $ipAddress, $refererPage, $requestPage, $user, $filename, $phpSelf ){
		
		$output  =  '';
		
		$output  .='
						<tr>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.date('d/m/y H:i:s', strtotime($dateVisited)).'</font>
							</td>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.$ipAddress.'</font>
							</td>  
							<td  style="border: 1px solid #FFFFFF; width: 7%; text-align: center;">
								<font color="ffd700">'.$os.'</font>
							</td> 
							<td style="border: 1px solid #FFFFFF; width: 7%; text-align: center;">
								<font color="ffd700">'.$browserName.'</font>
							</td> 
							<td style="border: 1px solid #FFFFFF; width: 8%; text-align: center;">
								<font color="ffd700">'.$browserVersion.'</font>
							</td>
							<td style="border: 1px solid #FFFFFF; width: 15%; word-wrap: break-word; text-align: center;">
								'.($refererPage != 'none' ? '<a style="color: #ffd700;" href="'.$refererPage.'">'.$refererPage.'</a>' :'<font color="ffd700">'.$refererPage.'</font>').'
							</td> 
							<td style="border: 1px solid #FFFFFF; width: 15%; word-wrap: break-word; text-align: center;">
								<a style="color: #ffd700;" href="http://'.$domainName.$requestPage.'">'.$domainName.$requestPage.'</a>
							</td> 
						</tr>';
		
		return $output ;
		
	}
	
	/**/
	function build_email_html_top(){
		
		$output  =  '';
		
		$output  .= '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>
	<body style="background-image:url(\'http://www.ycyrffgroupie.co.uk/images/background5.jpg\');  background-repeat: no-repeat; background-size: cover; background-color: #800080; width:99%;" link="ffd700" alink="ffd700" >
		<table style="width:100%;">
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:94%">';
				
		return $output ;
		
	}
	
	/**/
	function build_html_table_top(){
		
		$output  =  '';
		
		$output  .= '
					<table style="border: 1px solid #FFFFFF; width:100%; table-layout: fixed;">
						<tr>
							<th style="border: 1px solid #FFFFFF; width: 11%;"><font color="ffd700">Date Visited</font></th>
							<th style="border: 1px solid #FFFFFF; width: 11%;"><font color="ffd700">IP Address</font></th>
							<th style="border: 1px solid #FFFFFF; width: 7%;"><font color="ffd700">OS</font></th>
							<th style="border: 1px solid #FFFFFF; width: 7%;"><font color="ffd700">Browser Name</font></th>
							<th style="border: 1px solid #FFFFFF; width: 8%;"><font color="ffd700">Browser Version</font></th>
							<th style="border: 1px solid #FFFFFF; width: 15%;"><font color="ffd700">Referer Page</font></th>
							<th style="border: 1px solid #FFFFFF; width: 15%;"><font color="ffd700">Request Page</font></th>
						</tr>';
						
		return $output;
		
	}
	
	/**/
	function build_html_table_bottom(){
		
		$output  =  '';
		
		$output  .= '
					</table>';
		
		return $output;
		
	}
	
	/**/
	function build_email_html_bottom(){
		
		$output  =  '';
		
		$output  .= '
					<br>
					<br>
					<p><font color="ffd700">Thanks,
					<br>
					One nutty fan.</font></p>
				</td>
			</tr>
		</table>
	</body>
</html>';
		
		return $output;
		
	}
	
	/**/
	function build_email_html(){
		
		$output  =  '';
		$output  .= $this ->build_email_html_top();
		$output  .= '
					<table style="padding: 15px 0px;">
						<tr>
							<td>
								<font color="ffd700">Visitors that script can\'t dectect browser versions report:</font>
							</td>
						</tr>
					</table>';
		$output  .= $this ->get_list_of_visitor_browsercap_html();
		$output  .= '
					<table style="padding: 15px 0px;">
						<tr>
							<td>
								<font color="ffd700">Visitors that are using out of date browsers report:</font>
							</td>
						</tr>
					</table>';
		$output  .= $this ->get_list_of_visitor_unsupported_browsers_html();
		$output  .= '
					<table style="padding: 15px 0px;">
						<tr>
							<td>
								<font color="ffd700">All visitors report:</font>
							</td>
						</tr>
					</table>';
		$output  .= $this ->get_list_of_visitor_html();
		$output  .= $this ->build_email_html_bottom();
		
		return $output;
		
	}
	
	/**/
	function get_list_of_visitor_txt(){
		
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$output  =  '';
		
		$sql ="SELECT * FROM visitor";
		
		try{
			$query = $database->prepare($sql);
			$query ->execute();
			
			while($visitorsDetails = $query ->fetch()){
				
				$output  .= $this ->build_visitor_table_row_txt($visitorsDetails["dateVisited"], 
				$visitorsDetails["os"], $visitorsDetails["browser_name"],
				$visitorsDetails["browser_version"], $visitorsDetails["domainName"],
				$visitorsDetails["ipAddress"], $visitorsDetails["refererPage"],
				$visitorsDetails["requestPage"], $visitorsDetails["user"],
				$visitorsDetails["filename"], $visitorsDetails["phpSelf"]);
			}
			
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		
		return $output;
		
	}
	
	/**/
	/*function build_visitor_table_row_txt($os, $browserName, $browserVersion,
	$domainName, $ipAddress, $refererPage, $requestPage, $user, $filename, $phpSelf){
		
		$output  =  '';
		
		$output  .= "\n"
		.'|'."\t".$ipAddress."\t".'|'
		.$this ->word_wrap_txt($os, 7).'|'
		."\t".$browserName."\t".'|'
		."\t".$browserVersion."\t".'|'
		.$this ->word_wrap_txt($refererPage, 25)
		.$this ->word_wrap_txt('http://'.$domainName.$requestPage, 25);
		
		return $output ;
		
		
	}*/
	
	/*Coming back to this later*/
	function word_wrap_txt($string, $length){
		
		$line = '';
		$i = 0;
		
		$outputStringArray = str_split($string, $length);
		
		$noOFLines = count($outputStringArray) + 1;
		
		if (count($outputStringArray) == 1){
			
			$line .= "\t".$outputStringArray[0]."\t";
			
			$i++;
			
		}else{
			
			foreach ($outputStringArray as $outputString){
				//,"/t |"
				if ($noOFLines == $i){
					
					$line .= '|'."\t".$outputString."\t".'|';
					$line .= $i;
					
					$i++;
					
				}else{
					
					if ($i != 0){
						$line .= "\t".'          '."\t".'|';
					
					}
					
					$line .= '|'."\t".$outputString."\t".'|'."\n";
					//$line .= $i;
					
					$i++;
				}
				
			}
			
		}
		
		return $line;
		
	}
	
	function build_visitor_table_row_txt($dateVisited, $os, $browserName, $browserVersion,
	$domainName, $ipAddress, $refererPage, $requestPage, $user, $filename, $phpSelf){
		
		$output  =  '';
		
		$output  .= 'Date Visited: '.date('d/m/y H:i:s', strtotime($dateVisited))."\n"
		.'IP Address: '.$ipAddress."\n"
		.'OS: '.$os."\n"
		.'Browser Name: '.$browserName."\n"
		.'Browser Version: '.$browserVersion."\n"
		.'Referer Page: '.$refererPage."\n"
		.'Request Page: http://'.$domainName.$requestPage."\n"."\n";
		
		return $output ;
		
		
	}
	
	/**/
	function build_email_txt_bottom(){
		
		$output  =  '';
		
		$output  .= 'Thanks,'."\n".
				'One nutty fan.';
		
		return $output;
		
	}
	
	/**/
	function build_email_txt(){
		
		$output  =  '';
		$output  .= 'Visitors that script can\'t dectect browser versions report:'."\n\n";
		$output  .= $this ->get_list_of_visitor_browsercap_txt();
		$output  .= 'Visitors that are using out of date browsers report:'."\n\n";
		$output  .= $this ->get_list_of_visitor_unsupported_browsers_txt();
		$output  .= 'All visitors report:'."\n\n";
		$output  .= $this ->get_list_of_visitor_txt();
		$output  .= $this ->build_email_txt_bottom();
		
		return $output;
		
	}
	
	/**/
	function cleanVisitorTable(){
		
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$sql = "TRUNCATE TABLE visitor"; 
		
		try{
			
			$query = $database->exec($sql);
			
			echo 'Succesfully ran rhe clean up operation.';
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		
		}
		
	}
	
	
	/**/
	function get_list_of_visitor_browsercap_html(){
	
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$output  =  '';
		
		$sql ="SELECT * FROM visitor WHERE browser_version = 0";
		 
		try{
			$query = $database->prepare($sql);
			$query ->execute();
			
			$output  .= $this ->build_html_table_top();
			
			while($visitorsDetails = $query ->fetch()){
				
				$output  .= $this ->build_visitor_table_row_html($visitorsDetails["dateVisited"],
				$visitorsDetails["os"], $visitorsDetails["browser_name"],
				$visitorsDetails["browser_version"], $visitorsDetails["domainName"],
				$visitorsDetails["ipAddress"], $visitorsDetails["refererPage"],
				$visitorsDetails["requestPage"], $visitorsDetails["user"],
				$visitorsDetails["filename"], $visitorsDetails["phpSelf"]);
			}
			
			$output  .= $this ->build_html_table_bottom();
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		
		return $output;
		
	}
	
	/**/
	function get_list_of_visitor_unsupported_browsers_html(){
	
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$output  =  '';
		
		$sql ="SELECT * FROM visitor WHERE 
		browser_name = 'Firefox' AND browser_version BETWEEN  1 AND 4
		OR browser_name = 'Chrome' AND browser_version BETWEEN  1 AND 14
		OR browser_name = 'IE' AND browser_version BETWEEN  1 AND 6
		OR browser_name = 'Opera' AND browser_version BETWEEN  1 AND 9
		OR browser_name = 'Safari' AND browser_version BETWEEN  1 AND 5.1
		ORDER BY dateVisited";
		 
		try{
			$query = $database->prepare($sql);
			$query ->execute();
			
			$output  .= $this ->build_html_table_top();
			
			while($visitorsDetails = $query ->fetch()){
				
				$output  .= $this ->build_visitor_table_row_html($visitorsDetails["dateVisited"],
				$visitorsDetails["os"], $visitorsDetails["browser_name"],
				$visitorsDetails["browser_version"], $visitorsDetails["domainName"],
				$visitorsDetails["ipAddress"], $visitorsDetails["refererPage"],
				$visitorsDetails["requestPage"], $visitorsDetails["user"],
				$visitorsDetails["filename"], $visitorsDetails["phpSelf"]);
			}
			
			$output  .= $this ->build_html_table_bottom();
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		
		return $output;
		
	}
	
	/**/
	function get_list_of_visitor_browsercap_txt(){
		
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$output  =  '';
		
		$sql = "SELECT * FROM visitor WHERE browser_version = 0";
		
		try{
			$query = $database->prepare($sql);
			$query ->execute();
			
			while($visitorsDetails = $query ->fetch()){
				
				$output  .= $this ->build_visitor_table_row_txt($visitorsDetails["dateVisited"], 
				$visitorsDetails["os"], $visitorsDetails["browser_name"],
				$visitorsDetails["browser_version"], $visitorsDetails["domainName"],
				$visitorsDetails["ipAddress"], $visitorsDetails["refererPage"],
				$visitorsDetails["requestPage"], $visitorsDetails["user"],
				$visitorsDetails["filename"], $visitorsDetails["phpSelf"]);
			}
			
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		
		return $output;
		
	}
	
	/**/
	function get_list_of_visitor_unsupported_browsers_txt(){
		
		require("/var/www/websites/redesign2013/includes/connection.php");
		
		$output  =  '';
		
		$sql = "SELECT * FROM visitor WHERE 
		browser_name = 'Firefox' AND browser_version BETWEEN  1 AND 4
		OR browser_name = 'Chrome' AND browser_version BETWEEN  1 AND 14
		OR browser_name = 'IE' AND browser_version BETWEEN  1 AND 6
		OR browser_name = 'Opera' AND browser_version BETWEEN  1 AND 9
		OR browser_name = 'Safari' AND browser_version BETWEEN  1 AND 5.1
		ORDER BY dateVisited";
		
		try{
			$query = $database->prepare($sql);
			$query ->execute();
			
			while($visitorsDetails = $query ->fetch()){
				
				$output  .= $this ->build_visitor_table_row_txt($visitorsDetails["dateVisited"], 
				$visitorsDetails["os"], $visitorsDetails["browser_name"],
				$visitorsDetails["browser_version"], $visitorsDetails["domainName"],
				$visitorsDetails["ipAddress"], $visitorsDetails["refererPage"],
				$visitorsDetails["requestPage"], $visitorsDetails["user"],
				$visitorsDetails["filename"], $visitorsDetails["phpSelf"]);
			}
			
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}
		
		return $output;
		
	}
	
	/**/
	/*function (){
		
		
		
	}*/

}

?>