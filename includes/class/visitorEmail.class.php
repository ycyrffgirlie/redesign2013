<?php
/*@Author; Christine A. Black
@Version:0.1
@todo: Finish the word_wrap method.

Version 0.1 - Added the visitor e-mail class to the site. */

class visitorEmail{
	
	
	/*Builds the html version of the email.*/
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
	
	/*Builds the text version of the email.*/
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
	
	/*Builds the text version of the bottom of the email.*/
	function build_email_txt_bottom(){
		
		$output  =  '';
		
		$output  .= 'Thanks,'."\n".
				'One nutty fan.';
		
		return $output;
		
	}
	
	/*Builds the html version of the bottom of the email.*/
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
	
	/*Builds the html version of the top of the email.*/
	function build_email_html_top(){
		
		$output  =  '';
		
		$output  .= '<!DOCTYPE HTML PUBLIC\"-//W3C//DTD HTML 4.01 Transitional//EN\"\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
	<head></head>
	<body style="background-color: #800080; width:99%;" link="ffd700" alink="ffd700" >
		<table style="width:100%;">
			<tr>
				<td style="width:5%">&nbsp;</td>
				<td style="width:94%">';
				
		return $output ;
		
	}
	
	/*Builds the html version of the bottom of the table.*/
	function build_html_table_bottom(){
		
		$output  =  '';
		
		$output  .= '
					</table>';
		
		return $output;
		
	}
	
	/*Builds the html version of the top of the table.*/
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
	
	/*Builds the html version  a row of the table.*/
	function build_visitor_table_row_html($dateVisited = "22/10/14 20:58:56", $os = "Linux", 
	$browserName = "Firefox", $browserVersion = 5,$domainName = "ycyrffgroupie.co.uk", 
	$ipAddress = "127.0.0.1", $refererPage = "none", $requestPage = "none", $user = "none", 
	$filename = "none", $phpSelf  = "none"){
		
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
	
	/*Builds the text version  a row of the table.*/
	function build_visitor_table_row_txt($dateVisited =  "22/10/14 20:58:56", $os = "Linux", 
	$browserName = "Firefox", $browserVersion = 5, $domainName = "ycyrffgroupie.co.uk", 
	$ipAddress = "127.0.0.1", $refererPage = "none", $requestPage = "none", $user = "none", 
	$filename = "none", $phpSelf = "none"){
		
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
	
	/*Deletes all the data in the visitor table.*/
	function cleanVisitorTable(){
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
		$sql = "TRUNCATE TABLE visitor"; 
		
		try{
			
			$query = $database->exec($sql);
			
			echo 'Succesfully ran rhe clean up operation.';
			
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		
		}
		
	}
	
	/*Builds the headers of the email. Cleans the visitor table. Builds the body of the emails. 
	Sends the email. Logs the email for debugging  purposes. */
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
		
		if (mail($to,$subject,$message, $headers)){
			
			$output = 'Email was sent.';
			
		}else{
			
			$output = "Email wasn't sent.";
			
		}
		
		
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
		
		echo $message;
		
		return $output ;
		
		
	}
	
	/*Gets a html version list of all visitors.*/
	function get_list_of_visitor_html(){
	
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
		$output  =  '';
		
		$sql ="SELECT * FROM visitor";
		
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
	
	/*Gets a text version list of sll visitors.*/
	function get_list_of_visitor_txt(){
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
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
	
	/*Gets a html version list of visitors that using browser script couldn't dectect version.*/
	function get_list_of_visitor_browsercap_html(){
	
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		 
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
	
	/*Gets a text version list of visitors that using browser script couldn't dectect version.*/
	function get_list_of_visitor_browsercap_txt(){
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
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
	
	/*Gets a html version list of visitors that are using unsupported browsers.*/
	function get_list_of_visitor_unsupported_browsers_html(){
	
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
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
	
	/*Gets a text version list of visitors that are using unsupported browsers.*/
	function get_list_of_visitor_unsupported_browsers_txt(){
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}	
		
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
	
	/**/
	/*function (){
		
		
		
	}*/

}

?>