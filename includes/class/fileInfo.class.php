<?php
/*@Author; Christine A. Black
@Version:0.4
@todo:  

Version 0.4 - Added another file to the skipped list.
Version 0.3 - Fixed for live server, fixed PHP notices and added another check for update_test.
Version 0.2 - Make it work with about.php and fanprofile.php. abd added comments and tidy up the file.
Version 0.1 - Added the fileinfo class to the site. */

class fileInfo {

	public $filesDetails, $updatedFiles, $addedFiles;
	
	/*Creates the html version of added  files table*/
	function added_files_table_html(){
		
		$output  =  '';
		$output  .= $this ->build_html_table_top();
		
		$addedFiles = $this ->addedFiles;
		
		$i  =0;
		
		while ($i < count($addedFiles)){
			
			$output  .= $this ->build_table_row_html($addedFiles[$i]["name"],$addedFiles[$i]["title"],$addedFiles[$i]["datelastmodified"]);
			
			$i ++;
			
			
		}
		
		$output  .= $this ->build_html_table_bottom();
		
		return $output;
		
	}
	
	/*Creates the text version of added  files table*/
	function added_files_table_txt(){
		
		$output  =  '';
		
		$addedFiles = $this ->addedFiles;
		
		$i  =0;
		
		while ($i < count($addedFiles)){
			$output .= $this ->build_table_row_txt($addedFiles[$i]["name"],$addedFiles[$i]["title"],$addedFiles[$i]["datelastmodified"]);
			$i ++;
		}
		
		return $output;
		
	}
	
	/*Builds the html version of the email.*/
	function build_email_html(){

		$output  =  '';
		$output  .= $this ->build_email_html_top();
		$output  .= $this -> fileInfo_table();
		
		if (count($this ->updatedFiles)>1){
		
			$output .= '
					<table style="padding: 15px 0px;">
						<tr>
							<td>
								<font color="ffd700">Pages that have been updated:</font>
							</td>
						</tr>
					</table>';
			$output .= $this ->updated_files_table_html();
		}
		
		if (count($this ->addedFiles)>1){
			$output .= '
					<table style="padding: 15px 0px;">
						<tr>
							<td>
								<font color="ffd700">Pages that have been added:</font>
							</td>
						</tr>
					</table>';
			$output .= $this ->added_files_table_html();
		}
		
		$output  .= $this ->build_email_html_bottom();
		
		return $output;
		
		
	}
		
	/*Builds the html version of the bottom of the email.*/
	function build_email_html_bottom(){
		
		$output  =  '';
		
		$output  .= '	
				<table style="padding: 15px 0px;">
						<tr>
							<td>
							<br>
							<br>
							<p><font color="ffd700">Thanks,
							<br>
							One nutty fan.</font></p>
							</td>
						</tr>
					</table>
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
	
	/*Builds the text version of the email.*/
	function build_email_txt(){
	
		$output  =  '';
		$output = $this ->fileInfo_table_txt();
		if (count($this ->updatedFiles)>1){
			$output .= 'Pages that have been updated:'."\n\n";
			$output .= $this ->updated_files_table_txt();
		}
		
		if (count($this ->addedFiles)>1){
		
			$output .= 'Pages that have been added:'."\n\n";
			$output .= $this ->added_files_table_txt();
		}
		
		$output .= $this ->build_email_txt_bottom();
		
		
		return $output;
	
	}
	
	/*Builds the text version of the bottom of the email.*/
	function build_email_txt_bottom(){
		
		$output  =  '';
		
		$output  .= 'Thanks,'."\n".
				'One nutty fan.';
		
		return $output;
		
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
							<th style="border: 1px solid #FFFFFF; width: 11%;"><font color="ffd700">File name</font></th>
							<th style="border: 1px solid #FFFFFF; width: 11%;"><font color="ffd700">Page Title</font></th>
							<th style="border: 1px solid #FFFFFF; width: 7%;"><font color="ffd700">Date Last Modified</font></th>
						</tr>';
						
		return $output;
		
	}
	
	/*Builds the html version of the top of the  updated files table.*/
	function build_html_updated_table_top(){
		
		$output  =  '';
		
		$output  .= '
					<table style="border: 1px solid #FFFFFF; width:100%; table-layout: fixed;">
						<tr>
							<th style="border: 1px solid #FFFFFF; width: 11%;"><font color="ffd700">File name</font></th>
							<th style="border: 1px solid #FFFFFF; width: 7%;"><font color="ffd700">Date Last Modified</font></th>
						</tr>';
						
		return $output;
		
	}
	
	/*Builds the html version  a row of the table.*/
	function build_table_row_html($name, $title, $datelastmodified){
	
		$output  =  '';
		
		$output  .='
						<tr>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.$name.'</font>
							</td>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.$title.'</font>
							</td>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.$datelastmodified.'</font>
							</td>
						</tr>';
						
		return $output;
	}
	
	/*Builds the tetxt version  a row of the table.*/
	function build_table_row_txt($name, $title, $datelastmodified){
	
		$output  =  '';
		
		$output  .='
Name: '.$name."\n"
.'Title: '.$title."\n"
.'Date Last Modified: '.$datelastmodified."\n"."\n";
		
		return $output;
	
	
	}
	
	/*Builds the html version  a row of the tupdated files table.*/
	function build_updated_table_row_html($name, $datelastmodified){
	
		$output  =  '';
		
		$output  .='
						<tr>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.$name.'</font>
							</td>
							<td style="border: 1px solid #FFFFFF; width: 11%; text-align: center;">
								<font color="ffd700">'.$datelastmodified.'</font>
							</td>
						</tr>';
						
		return $output;
	}
	
	/*Builds the text version  a row of the tupdated files table*/
	function build_updared_table_row_txt($name,$datelastmodified){
	
	$output  =  '';
		
		$output  .='
Name: '.$name."\n"
.'Date Last Modified: '.$datelastmodified."\n"."\n";
		
		return $output;
	
	}
	
	/*Update database. Builds the headers of the email.  Builds the body of the emails. 
	Sends the email. Logs the email for debugging  purposes. */
	function email(){
		
		$filesDetails = $this ->getfilesinfo();
		$this ->update_datebase();
		
		$to = 'ycyrffgroupie@gmail.com';
		$subject = 'File Information and update';
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
		$headers ='MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: multipart/alternative; boundary='.$mime_boundary. "\r\n";
		$headers .='From:  "Webmistress" <webmistress@ycyrffgroupie.co.uk>'. "\r\n";	
		
		$htmlEmail = $this ->build_email_html();
		$txtEmail = $this ->build_email_txt();
		
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
		
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		
		if ($term == 'xterm'  || $shell == '/usr/local/cpanel/bin/jailshell'){
	
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
				
				$logLocation = '/var/www/websites/redesign2013/logs/';
			
			}else{
				
				$logLocation = '/home/ycyrf718/logs/';
				
			}
		
		}else{
			if ($documentRoot == '/var/www/websites/redesign2013'){
		
				$logLocation = '/var/www/websites/redesign2013/logs/';
		
			}else{
		
				$logLocation = '/home/ycyrf718/logs/';
			}
		}
		
		$filename = 'fileInfoEmail.txt';
		
		try {
			$file = fopen($logLocation.$filename,'c');
	
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
		return $output;
		
	}
	
	/*Test if the file already exist in the database*/
	function file_exist_test($filename){
	
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		if ($term == 'xterm'  || $shell == '/usr/local/cpanel/bin/jailshell'){
	
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
				
				require("/var/www/websites/redesign2013/includes/connection.php");
		
			}else{
				
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
				
			}
			
		}else{
			
			if ($documentRoot == '/var/www/websites/redesign2013'){
				
				require("/var/www/websites/redesign2013/includes/connection.php");
			
			}else{
		
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
			}
		
		}
		
		$numofrows = 0;
		
		$sql = 'SELECT count(*) FROM `pages` WHERE `filename` = "'.$filename.'"';
		$query = $database ->prepare($sql );
		$query ->execute();

		$numofrows = $query ->fetchColumn();
		
		return $numofrows;
	
	}
	
	/*Creates the html version of all  files table*/
	function fileInfo_table(){
		
		$output  =  '';
		$output  .= $this ->build_html_table_top();
		
		$filesDetails = $this ->filesDetails;
		
		$i  =0;
		
		while ($i < count($filesDetails)){
			
			$output  .= $this ->build_table_row_html($filesDetails[$i]["name"],$filesDetails[$i]["title"],$filesDetails[$i]["datelastmodified"]);
			$i ++;
			
			
		}
		
		$output  .= $this ->build_html_table_bottom();
		
		return $output;
		
	}
	
	/*Creates the text version of all  files table*/
	function fileInfo_table_txt(){
		
		$output  =  '';
		
		$filesDetails = $this ->filesDetails;
		
		$i  =0;
		
		while ($i < count($filesDetails)){
			$output .= $this ->build_table_row_txt($filesDetails[$i]["name"],$filesDetails[$i]["title"],$filesDetails[$i]["datelastmodified"]);
			$i ++;
		}
		
		return $output;
		
	}
	
	/*Gets details about the about files*/
	function get_about_pages(){
		
		$files = Array(
		0 =>array('name'=>'/about.html', 'title' => 'About'), 
		1 =>array('name'=>'/about1.html', 'title' => 'About'),
		2 =>array('name'=>'/am.html', 'title' => 'Am'), 
		3 =>array('name'=>'/am1.html', 'title' => 'Am')
		);
		
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell'){
	
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
			
				$patten = "/var/www/websites/redesign2013";
			
			}else{
		
				$patten = "/home/ycyrf718/public_html/";
		
			}
	
		}else{

			if ($documentRoot == '/var/www/websites/redesign2013'){
			
				$patten = "/var/www/websites/redesign2013";
			
			}else{
			
				$pattern = "/home/ycyrf718/public_html/";
			
			}

		}
		
		
		$fileInfo = Array();
		$i = 0;
		
		foreach ($files as $file){
			
			
			$fileInfo[$i]["name"] = $file["name"];
			$fileInfo[$i]["title"]  = $file["title"];
			$fileInfo[$i]["datelastmodified"] = date('Y-m-d H:i:s',filemtime($patten.'/about.php'));
			$i ++;
			
		}
		
		return $fileInfo;
		
	}	
	
	/*Gets files that stored on server*/
	function getfiles(){
		
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell'){
	
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
			
				$pattern = "/var/www/websites/redesign2013/*";
			
			}else{
		
				$pattern = "/home/ycyrf718/public_html/*";
		
			}
	
		}else{

			if ($documentRoot == '/var/www/websites/redesign2013'){
			
				$pattern = "/var/www/websites/redesign2013/*";
			
			}else{
			
				$pattern = "/home/ycyrf718/public_html/*";
			
			}

		}
		
		$files = glob($pattern);
		$i = 0;
		$counter = 0;

		$skipped_dirs = array('admin'
						, 'bugs'
						, 'cgi-bin'
						,'christine'
						,'clone'
						,'css'
						,'dev'
						,'forum'
						,'images'
						,'includes'
						,'llwybrllaethog'
						,'other'
						,'phplinks'
						,'redesign20'
						,'seo'
						,'uploads'
						,'log'
						,'scripts'
					);

		$skipped_dir = implode("|", $skipped_dirs);
		$skipped_dir = '('.$skipped_dir.')';
		
		$skipped_files =array('.shtml'
					,'.xml'
					,'about'
					,'1.html'
					,'.txt'
					,'.htc'
					,'Sqh40j'
					,'dcc24'
					,'.ico'
					,'4048'
					,'2.html'
					,'monotypic'
					,'.jpg'
					,'new_guestbook'
					,'test'
					,'menu'
					,'update_me'
					,'.md'
					,'template'
					,'phpinfo'
					,'.ajax.php'
					,'contact.php'
					,'imateapot.php'
					,'.db'
					,'.JPG'
					,'.LOG'
					,'.gif'
					,'.mp3'
					,'.htaccess'
					,'.class'
					,'chantalprofile.html'
					,'khmerhunprofile.html'
					,'lukeprofile.html'
					,'christineprofile.html'
					,'ffwrchamotobeicsprofile.html'
					,'jeniwineprofile.html'
					,'llewelynrichardsprofile.html'
					,'mrgroovyprofile.html'
					,'rhysprofile.html'
					,'error_log'
				);

		$skipped_file = implode("|", $skipped_files);
		$skipped_file = '('.$skipped_file.')';
		$allowed_dirs = array ('Images'
					,'games'
					,'interviews'
					,'lyrics'
					,'news'
					,'profiles'
					,'reviews'
					,'sound_clips'
					,'Images'
				);
				

		$allowed_dir = implode("|",$allowed_dirs);
		$allowed_dir  = '('.$allowed_dir .')';

		foreach ($files as $file){
	

			if (preg_match('/'.$allowed_dir.'/',$file)&&
			!preg_match('/'.$skipped_file.'/',$file)){
				
			
				$dir[$counter] =$file;
				$counter++;
				
			}elseif(preg_match('/.html|.php|.htm/', $file) &&
			!preg_match('/'.$skipped_file.'/',$file) && 
			!preg_match('%'.$skipped_dir.'%',$file)){
			
					$cleanerfilespath[$i] = $file;
					$i++;

			}
		}
		

		$i = 0;

		foreach($dir as $directory){
	
			$pattern = $directory;

			if (is_dir($pattern)){
				if ($dirhandler = opendir($pattern)){
					while (($file = readdir($dirhandler)) !== false){
						if ($file != "." && $file != "..") {
							$files[$i] = $pattern.'/'.$file;
							$i++;
						}
					}
		
				closedir($dirhandler);
		
				}
			}
	
		}

		$i = 0;
		$counter = 0;

		foreach ($files as $file){
			if (preg_match('/.html|.php|.htm/', $file)  && !preg_match('/contact.php/', $file)  && !preg_match('/fanprofile.php/', $file)
			 && !preg_match('/ajax.php/', $file) && !preg_match('/'.$skipped_file.'/',$file) && !preg_match('%Images/site%',$file)
			){
					$cleanerfiles1[$i] = $file;
					$i++;
			}
		}
		
		$filepaths = array_merge($cleanerfilespath, $cleanerfiles1);
		
		return $filepaths;
	}
	
	/*Gets details about files*/
	function getfilesinfo(){

		$files = $this  ->getfiles();
		
		
	
		$i = 0;

			while ($i < count($files)){
				$file = $files[$i];
				$buffers[$i] = file($file);
		
				$counter = 0;
				
				$filesinfo[$i]["name"] = "";
				$filesinfo[$i]["title"] = '';
				$filesinfo[$i]["datelastmodified"]  = "";
				
				if (preg_match( '%/var/www/websites/redesign2013%', $file)){
				
					$filesinfo[$i]["name"] = preg_replace('%/var/www/websites/redesign2013%', '', $file);
					$patten = '/var/www/websites/redesign2013';
				
				}else{
					
					$filesinfo[$i]["name"] = preg_replace('%/home\/ycyrf718\/public_html%', '', $file);
					$patten = '/home\/ycyrf718\/public_html';
				
				}
		
				while ($counter < count($buffers[$i])){
					$buffer = $buffers[$i][$counter];
			
					if (preg_match('/<H1>/i',$buffer)){
						
						$filesinfo[$i]["title"] = trim(strip_tags($buffer), "\n");
				
					}/*else{
					
						$filesinfo[$i]["title"] = '';
					
					}*/
			
				
					$counter++;
			
				}
		
			$filesinfo[$i]["datelastmodified"] = date('Y-m-d H:i:s',filemtime($file));

			$i++;
		}
		
		$filesinfo2 = $this ->get_profiles_pages();
		
		if (file_exists($patten.'/about.php')){
			
			$filesinfo1= $this ->get_about_pages();
			$fileInfo  = array_merge($filesinfo, $filesinfo1,$filesinfo2);
			
		}else{
			
			$fileInfo  = array_merge($filesinfo, $filesinfo2);
			
		}
		
		$this ->filesDetails = $fileInfo;
		
		
		return $fileInfo;
	}
	
	/*Gets details about  the fan profiles files*/
	function get_profiles_pages(){
	
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		if ($term == 'xterm' || $shell == '/usr/local/cpanel/bin/jailshell'){
		
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
			
				require("/var/www/websites/redesign2013/includes/connection.php");
				$patten = "/var/www/websites/redesign2013";
			
			}else{
		
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
				$patten = "/home/ycyrf718/public_html/";
		
			}
		
		
		}else{
		
			if ($documentRoot  == '/var/www/websites/redesign2013'){
		
				require("/var/www/websites/redesign2013/includes/connection.php");
				$patten = "/var/www/websites/redesign2013";
		
			}else{
			
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
				$patten = "/home/ycyrf718/public_html/";
				
			}
		}
		
		$sql = "SELECT filename from fan_profile";
		$query  =$database ->prepare($sql);
		$query ->execute();
		
		$files = $query ->fetchAll();
		$fileInfo = Array();
		$i = 0;
		
		foreach ($files as $file){
			
			if (isset($file["filename"])){
			
				$fileInfo[$i]["name"] = $file["filename"];
				$fileInfo[$i]["title"]  = "";
				$fileInfo[$i]["datelastmodified"] = date('Y-m-d H:i:s',filemtime($patten.'/profiles/fanprofile.php'));
				$i ++;
			
			}
		}
		
		return $fileInfo;
		
	}	
	
	/*This update the  database and creates  lists of updated files and added files*/
	function update_datebase(){
	
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		$filesDetails = $this ->filesDetails;
		$i = 0;
		$countUpdated = 0;
		$CountAdded = 0;
		$updatedFiles = '';
		$addedFiles = '';
		
		
		if ($term == 'xterm'  || $shell == '/usr/local/cpanel/bin/jailshell'){
	
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
				
				require("/var/www/websites/redesign2013/includes/connection.php");	
				
			}else{
				
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
				
			}
	
		}else{
			
			if ($documentRoot == '/var/www/websites/redesign2013'){
				
				require("/var/www/websites/redesign2013/includes/connection.php");
				
			}else{
				
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
			}
			
		}
	
		while ($i < count($filesDetails)){
			$numofrows = $this ->file_exist_test($filesDetails[$i]["name"]);
			$numofrows2 = 0;
			$numofrows2 = $this ->update_test($filesDetails[$i]["name"], $filesDetails[$i]["datelastmodified"]);
			
			if ($numofrows >= 1){
			
				if ($numofrows2 == 0){
					
					$sql = 'UPDATE pages SET datelastmodified = "'.$filesDetails[$i]["datelastmodified"].'" where filename ="'.$filesDetails[$i]["name"].'"';
					
					try{
		
						$query = $database ->prepare($sql);
						$query ->execute();
					} catch(PDOException $error){
		
						echo 'Error with query. '.$error->getMessage();
						}
					
					$updatedFiles[$countUpdated]["name"] = $filesDetails[$i]["name"];
					$updatedFiles[$countUpdated]["datelastmodified"] = $filesDetails[$i]["datelastmodified"];
					$countUpdated ++;
				}
			
			}else{
			
				$sql = sprintf("INSERT INTO pages(filename, title, facebooktitle, datelastmodified )
					VALUES('".$filesDetails[$i]["name"]."', %s, %s,'".$filesDetails[$i]["datelastmodified"]."')",
					$database ->quote($filesDetails[$i]["title"]),
					$database ->quote($filesDetails[$i]["title"])
					);
				
				try{
		
					$query = $database ->prepare($sql);
					$query ->execute();
				} catch(PDOException $error){
		
					echo 'Error with query. '.$error->getMessage();
				}
				
				$addedFiles[$CountAdded]["name"] = $filesDetails[$i]["name"];
				$addedFiles[$CountAdded]["title"] = $filesDetails[$i]["title"];
				$addedFiles[$CountAdded]["datelastmodified"] = $filesDetails[$i]["datelastmodified"];
				$CountAdded ++;
				
			}
			
			
			$i ++;
	
		}
		
		$this ->updatedFiles = $updatedFiles;
		$this ->addedFiles = $addedFiles;
		
		
	}

	/*Creates the html version of updated  files table*/
	function updated_files_table_html(){
		
		$output  =  '';
		$output  .= $this ->build_html_updated_table_top();
		
		$updatedFiles= $this ->updatedFiles;
		
		$i  =0;
		
		while ($i < count($updatedFiles)){
			
			$output  .= $this ->build_updated_table_row_html($updatedFiles[$i]["name"],$updatedFiles[$i]["datelastmodified"]);
			$i ++;
			
			
		}
		
		$output  .= $this ->build_html_table_bottom();
		
		return $output;
		
	}
	
	/*Creates the text version of updated  files table*/
	function updated_files_table_txt(){
		
		$output  =  '';
		
		$updatedFiles= $this ->updatedFiles;
		
		$i  =0;
		
		while ($i < count($updatedFiles)){
			$output .= $this ->build_updared_table_row_txt($updatedFiles[$i]["name"],$updatedFiles[$i]["datelastmodified"]);
			$i ++;
		}
		
		return $output;
		
	}
	
	/*Test if the file needs updating in the database*/
	function update_test($filename, $datelastmodified){
	
		$term =  isset($_SERVER["TERM"])? $_SERVER["TERM"] : "";
		$shell= isset($_SERVER["SHELL"])? $_SERVER["SHELL"] : '';
		$documentRoot = isset($_SERVER["DOCUMENT_ROOT"])? $_SERVER["DOCUMENT_ROOT"]:'';
		
		if ($term == 'xterm'  || $shell == '/usr/local/cpanel/bin/jailshell'){
	
			if (preg_match( '%/var/www/websites/redesign2013%', $_SERVER["PWD"])){
				
				require("/var/www/websites/redesign2013/includes/connection.php");	
				
			}else{
				
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
				
			}
	
		}else{
			
			if ($documentRoot == '/var/www/websites/redesign2013'){
				
				require("/var/www/websites/redesign2013/includes/connection.php");
				
			}else{
				
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
			}
			
		}
		
		$numofrows  = 0;
		$sql = 'SELECT count(*) FROM pages WHERE filename ="'.$filename.'" AND datelastmodified = "'.$datelastmodified.'"';
		$query  =$database ->prepare($sql);
		$query ->execute();
		
		$numofrows = $query ->fetchColumn();
		
		if ($numofrows == 0){
			
			$sql = 'SELECT datelastmodified FROM pages WHERE filename = "'.$filename.'"';
			$query  =$database ->prepare($sql);
			$query ->execute();
		
			$storeDates = $query ->fetch();
			$storeDate = $storeDates["datelastmodified"];
		
			if ($storeDate  > $datelastmodified){
			
				$numofrows = 1;
			
			}
		
		}
		
		return $numofrows;
		
	
	}
	
	/*function (){
		
		
		
	}*/	
	
}

?>