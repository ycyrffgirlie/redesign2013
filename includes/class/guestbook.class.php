<?php
/*@Author; Christine A. Black
@Version:0.1
@todo: 

Version 0.1 - Added the guestbook class to the site. */

class guestbook{

	public $guestbookMessages, $noofrows, $page, $totalPages;
	
	/*This convert html into plain text*/
	function converthtmlToPlain($code){
		$output = htmlentities($code);
		
		return $output;
	}
	
	/*This displays a comment on the guestbook.*/
	function display_comment($name, $website, $comment, $datePosted, $edited, $editedDate, $editedBy, $messageId){
		$output = '';
		
		$output .= '
	<p>
		Name / Enw: '.$name.'
		<br />
		Website / Gwe safle: '.(isset($website)? '<a class="normal" target="_blank" href="http://'.$website.'">'.$website.'</a>':'').'
		<br />
		Comment / Sylw: '.$comment.'
		<br />
		Date posted / Dyddiad ychwanegwyd: '.date("l, jS F Y H:i", strtotime($datePosted)).'
		<!--<br>
		Message Id: '.$messageId.'-->
	</p>';
	
		if ($edited == 1){
			$output .= '
	<p>Edited by '.$editedBy.' on '.date('d/m/Y H:i:s', strtotime($editedDate)).'.
		<br />
		Golgodd gan '.$editedBy.' ar '.date('d/m/Y H:i:s', strtotime($editedDate)).'.
	</p>';
		}
		
		return $output;
	}
	
	/*This displays a comment with hr on the guestbook.*/
	function display_comment_hr($name, $website, $comment, $datePosted, $edited, $editedDate, $editedBy, $messageId){
		$output = '';
		
		$output .= '
	<p>
		Name / Enw: '.$name.'
		<br />
		Website / Gwe safle: '.(isset($website)? '<a class="normal" target="_blank" href="http://'.$website.'">'.$website.'</a>':'').'
		<br />
		Comment / Sylw: '.$comment.'
		<br />
		Date posted / Dyddiad ychwanegwyd: '.date("l, jS F Y H:i", strtotime($datePosted)).'
		<!--<br>
		Message Id: '.$messageId.'-->
	</p>';
		
		if ($edited == 1){
			$output .= '
	<p>Edited by '.$editedBy.' on '.date('d/m/Y H:i:s', strtotime($editedDate)).'.
		<br />
		Golgodd gan '.$editedBy.' ar '.date('d/m/Y H:i:s', strtotime($editedDate)).'.
	</p>';
		}
		
		$output .= '
	<hr>';
		
		return $output;
	}
	
	/*This loops through each comment and decides if need a hr attached to it*/
	function display_comments(){
		$guestbookMessages = $this ->guestbookMessages;
		$noofrows =$this ->noofrows; 
		$i = 0;
		$output = '';
		
		foreach ($guestbookMessages as $guestbookMessage){
			
			if ($i === $noofrows ){

				$output .= $this ->display_comment($guestbookMessage["name"], 
				$guestbookMessage["website"], $guestbookMessage["comment"], $guestbookMessage["posted_date"],
				$guestbookMessage['edited'], $guestbookMessage['edited_date'], $guestbookMessage['edited_by'],
				$guestbookMessage["message_id"]);

			}else{

				$output .= $this ->display_comment_hr($guestbookMessage["name"], 
				$guestbookMessage["website"], $guestbookMessage["comment"], $guestbookMessage["posted_date"],
				$guestbookMessage['edited'], $guestbookMessage['edited_date'], $guestbookMessage['edited_by'],
				$guestbookMessage["message_id"]);

			}
			
			$i++;

		}
		
		return $output;
		
	}
	
	/*Display guestbook*/
	function display_guestbook($filename){
		$this ->init_guestbook();
		
		$output = '';
		$output = $this ->display_comments();
		$output .= $this ->page_section();
		
		return  $output;
		
	}
	
	/*This didplays the main page of the admin section*/
	function display_guestbook_admin_default(){
		$output = '';
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
			
		}else{
				
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}
		
		$query = $database ->prepare("SELECT * FROM holding_Guestbook");
		$query ->execute();
		$comments = $query ->fetchAll();
		$i = 0;
		
		if (count($comments) > 0){
			$output = $this ->display_guestbook_admin_default_table_top();

			foreach ($comments as $comment){

				 $output .= $this ->display_guestbook_admin_default_table_row($i, $comment["name"], $comment["website"], $comment["comment"], $comment["posted_date"], $comment["message_id"]);
				
				$i++;


			}

			$output .= $this ->display_guestbook_admin_default_table_bottom();
		}else{
			$output = '<p>No comments to be displayed.</p>';
		}
		
		return $output;
	}
	
	/*This didplays the bottom of the table on the main page of the admin section*/
	function display_guestbook_admin_default_table_bottom(){
		$output = '';
		
		$output =  '
		</table>
		<div style="width: 173px; margin: 0px auto; padding: 10px 0px 0px 0px;">
			<button type="submit" formaction="guestbookAdmin.php?action=saveMulti">Save Multi</button>
			<button type="submit" formaction="guestbookAdmin.php?action=deleteMulti">Delete Multi</button>
		</div>
	</form>
	';
		
		return $output;
	}
	
	/*This didplays a row of the table on the main page of the admin section*/
	function display_guestbook_admin_default_table_row($i, $name, $website, 
	$comment, $postedDate, $messageId){
		$output = '';
		
		$output = '
			<tr>
				<td class="admin">
					<input type="checkbox" name="selectedrow['.$i.']">
				</td>
				<td class="admin">
					<input type="hidden" name="name['.$i.']" value="'.$name.'" />
					<p>'.$name.'</p>
				</td>';

			if ($website == null || $website ==" "){

				$output .= '
				<td class="admin" style="width: 115px;word-wrap: break-word; word-break: break-all;"></td>';

			}else{

				$output .= '
				<td class="admin" style="width: 115px; word-wrap: break-word; word-break: break-all;">
					<input type="hidden" name="website['.$i.']" value="'.$website.'" />
					<a class="normal" href="http://'. $website.'">'.$website.'</a>
				</td>';
				
			}
			
			$output .= '
				<td class="admin" style="width: 165px;">
					<input type="hidden" name="comment['.$i.']" value="'.$comment.'" />
					<p>'.$this ->truncate($comment, 43).'</p>
				</td>
				<td class="admin">
					<input type="hidden" name="postDate['.$i.']" value="'.$postedDate.'" />
					<p>'.date('d/m/ Y H:i:s', strtotime($postedDate)).'</p>
				</td>
				<td class="admin">
					<input type="hidden" name="messageId['.$i.']" value="'.$messageId.'" />
					<p>'.$messageId.'</p>
				</td>
				<td class="admin" style="width: 166px;">
					<input type="button" onclick="location.href=
				\'guestbookAdmin.php?action=edit&messageId='.$messageId.'\'" value="Edit" />
					<input type="button" onclick="location.href=
				\'guestbookAdmin.php?action=save&messageId='.$messageId.'\'" value="Save" />
					<input type="button" onclick="location.href=
				\'guestbookAdmin.php?action=delete&messageId='.$messageId.'\'" value="Delete" />
				</td>

			</tr>'."\n";
		
		return $output;
	}
	
	/*This didplays the top of the table on the main page of the admin section*/
	function display_guestbook_admin_default_table_top(){
		$output = '';
		
		$output = '
	<form action="" method="post">
		<table class="admin" style="    width: 735px;">
			<tr>
				<th></th>
				<th class="admin">Name</th>
				<th class="admin">Website</th>
				<th class="admin">Comment</th>
				<th class="admin">Date Posted</th>
				<th class="admin">Message Id</th>		
			</tr>';
		
		return $output;
	}
	
	/*This display the delete page of the admin section*/
	function display_guestbook_admin_delete(){
		$output = '';
		$messageId = isset($_GET['messageId'])? $_GET['messageId']: '';
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
				
		}else{
					
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}
		
		$query = $database ->prepare("SELECT * FROM holding_Guestbook where message_id = ".$messageId);
		$query ->execute();
		$comment = $query ->fetch();
		
		if (is_numeric($messageId)){
		
			$output = $this ->display_guestbook_admin_table_top();
			$output .= $this ->display_guestbook_admin_table_row($comment['name'], $comment['website'], $comment['posted_date'], $comment['message_id']);
			$output .= '
		</table>
		
		<p>Are you sure?</p>
		<form action="guestbookAdmin.php?action=deleteConfirm" method="post">
			<input type="hidden" name="sql" value="DELETE FROM holding_Guestbook where message_id = '.$messageId.'" />
			<input type="submit" value="Yes" />
			<input type="button" value="No" onclick="location.href=
			\'guestbookAdmin.php\'"  />
		</form>
	</div>';
	
		}else{
			
			$output = $this ->display_guestbook_admin_go_back();
			
		}
		
		
		return $output;
	}
	
	/*This is the page that updates the database*/
	function display_guestbook_admin_delete_confirm(){
		$output = '';
		$sql  = isset($_POST['sql'])? $_POST['sql']: '';
		$count = isset($_POST['count'] )? $_POST['count'] : 1;
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
				
		}else{
					
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}
		
		if (isset($sql)){
		
			try{
			
				$query = $database->exec($sql);
				
				$output = '<p>Succesfully deleted the comment'.($count > 1? 's':'').'.</p>';
				
			} catch(PDOException $error){
			
				$output = '<p>Error with query. '.$error->getMessage().'</p>';
			
			}
			
			$output .= '
		<input type="button" value="Go back" onclick="location.href=
			\'guestbookAdmin.php\'" />';
		
		}
				
		return $output;
	}
	
	/*This display the delete multi page of the admin section*/
	function display_guestbook_admin_delete_multi(){
		$output ='';
		$i = 0;
		$count = 0;
		$comments = array();
		$sql = ''; 
		
		while ($i < count($_POST['name'])){
			if ($_POST['selectedrow'][$i] === 'on'){
				$comments[$count]['name'] = $_POST['name'][$i];
				$comments[$count]['website'] = $_POST['website'][$i];
				$comments[$count]['comment'] = $_POST['comment'][$i];
				$comments[$count]['postDate'] = $_POST['postDate'][$i];
				$comments[$count]['messageId'] = $_POST['messageId'][$i];
				
				$count ++;
			}
			
			$i ++;
		}
		
		if ($count != 0){
		
			$output = $this ->display_guestbook_admin_table_top();
			$sql = 'DELETE FROM holding_Guestbook WHERE message_id IN (';
			
			foreach ($comments as $comment){
				$output .= $this ->display_guestbook_admin_table_row($comment['name'], $comment['website'], $comment['comment'], $comment['postDate'], $comment['messageId']);
				$sql .= $comment['messageId'].', ';
			}
			
			$sql = rtrim($sql, ", ");
			$sql .= ')';
			
			$output .= '
		</table>
		
		<p>Are you sure?</p>
		<form action="guestbookAdmin.php?action=deleteMultiConfirm" method="post">
			<input type="hidden" name="sql" value="'.$sql .'" />
			<input type="hidden" name="count" value="'.$count.'" />
			<input type="submit" value="Yes" />
			<input type="button" value="No" onclick="location.href=
			\'guestbookAdmin.php\'"  />
		</form>
	</div';
		}else{
			$output = $this ->display_guestbook_admin_go_back();
		}
	
		return $output;
		
	}
	
	/*This display the edit page of the admin section*/
	function display_guestbook_admin_edit(){
		$output = '';
		$messageId = isset($_GET['messageId'])? $_GET['messageId']: '';
		
		if (is_numeric($messageId)){
		
			if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
			
				require("/var/www/websites/redesign2013/includes/connection.php");
					
			}else{
						
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
			}
			
			$query = $database ->prepare("SELECT * FROM holding_Guestbook where message_id = ".$messageId);
			$query ->execute();
			$comment = $query ->fetch();
			
			$output = '
	<div id="content">
		<form action="guestbookAdmin.php?action=editSave&messageId='.$messageId.'" method="post">
			<div class="fieldline">
				<div class="fieldname"><label or="name">Name:</label></div>
				<div class="field">
					<input type="hidden" name="hname" value="'.$comment['name'].'" />
					<input type="" name="name" value="'.$comment['name'].'" />
				</div>
			</div>
			<div class="fieldline">
				<div class="fieldname"><label for="website">Website:</label></div>
				<div class="field">
					<input type="hidden" name="hwebsite" value="'.$comment['website'].'" />
					<input type="website" name="website" value="'.$comment['website'].'" />
				</div>
			</div>
			<div class="fieldline" style="min-height: 170px;">
				<div class="fieldname"><label  for="comment">Comment:</label></div>
				<div class="field">
					<input type="hidden" name="hcomment" value="'.$comment['comment'].'" />
					<textarea rows="11" cols="43" name="comment">'.$comment['comment'].'</textarea>
				</div>
			</div>
			<div class="clear"></div>
			<div class="fieldline">
				<div class="fieldname"><label>Date:</label></div>
				<div class="field">
				<input type="hidden" name="posted_date" value="'.$comment['posted_date'].'" />
				'.date('d/m/Y H:i:s', strtotime($comment['posted_date'])).'
				</div>
			</div>
			<div class="fieldline">
				<div class="fieldname"><label>Message ID:</label></div>
				<div class="field">'.$comment['message_id'] .'</div>
			</div>
			<div style="width: 47px; margin: 0 auto;">
				<input type="submit" value="Save"/>
			</div>
		</form>
	</div>';
		}else{
			
			$output = $this ->display_guestbook_admin_go_back();
			
		}
	
		return $output;
	}
	
	/*This display the edit save page of the admin section*/
	function display_guestbook_admin_edit_save(){
		$output = '';
		
		$messageId = isset($_GET['messageId'])? $_GET['messageId']: '';
		$sql = "UPDATE holding_Guestbook SET";
		$countEdits = 0;
		
		if ($_POST['hname'] !== $_POST['name']){
			$sql .= ' name ="'.$_POST['name'].'",';
			$countEdits ++;
		}
		
		if ($_POST['hwebsite'] !== $_POST['website']){
			$sql .= ' website ="'.$_POST['website'].'",';
			$countEdits ++;
		}
		
		if ($_POST['hcomment'] !== $_POST['comment']){
			$sql .= ' comment ="'.$_POST['comment'].'",';
			$countEdits ++;
		}
		
		if ($countEdits != 0){
			//$sql = rtrim($sql,',');
			$sql .= ' edited = 1, edited_date = now(), edited_by = "Christine" WHERE message_id = '.$messageId;
		}
		
		$output = '
	<div id="content">
		<div class="fieldline">
			<div class="fieldname"><p>Name: </p></div>
			<div class="field"><p>'.$_POST['name'].'</p></div>
		</div>
		<div class="fieldline">
			<div class="fieldname"><p>Website:</p></div>
			<div class="field"><p></p>'.$_POST['website'].'</div>
		</div>
		<div class="fieldline">
			<div class="fieldname"><p>Comment:</p></div>
			<div class="field"><p>'.$_POST['comment'].'</p></div>
		</div>
		<div class="fieldline">
			<div class="fieldname"><p>Date Posted: </p></div>
			<div class="field"><p>'.date('d/m/Y H:i:s', strtotime($_POST['posted_date'])).'</p></div>
		</div>
		<div class="fieldline">
			<div class="fieldname"><p>Message id: </p></div>
			<div class="field"><p></p>'.$messageId.'</div>
		</div>
		<form action="guestbookAdmin.php?action=editUpdate" method="post">
			<input type="hidden" name="sql" value = "'.$this ->converthtmlToPlain($sql).'" />
			<input type="hidden" name="countEdit" value = "'.$countEdits.'" />
			
			<input type="submit" value="Save"/>
			<input type="button" onclick="location.href=\'guestbookAdmin.php?action=edit&messageId='.$messageId.'\'"
			value="Cancel"/>
			
		</form>
	</div>';
		
		return $output;
	}
	
	/*This is the page that updates the database*/
	function display_guestbook_admin_edit_update(){
		$output = '';
		
		/*Gets data from previous page*/
		$sql = isset($_POST["sql"])?$_POST["sql"]:'';
		$countEdits = isset($_POST["countEdit"])?$_POST["countEdit"]:0;
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
				
		}else{
					
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}

		/*Updages the database if there has been a change*/
		if ($countEdits != 0){
			$query = $database ->prepare($sql);
			
			try{
				$query ->execute();
				$output = '
	<p>Comment has been sucessfully updated.</p>';
			} catch(PDOException $error){
			
				$output = '<p>Error with query. '.$error->getMessage().'</p>';
			
			}
		}
			
		/*Displays a message*/
		$output .= '
	<input type="button" onclick="location.href=\'guestbookAdmin.php\'"
	value="Contine"/>';
		
		return $output;
	}
	
	/*This displays the go back which is admin pages*/
	function display_guestbook_admin_go_back(){
		$output ='';
		
		$output = '
		<p>No comment to be displayed.</p>
		<input type="button" value="Go back" onclick="location.href=
			\'guestbookAdmin.php\'" />';
		
		return $output;
	}
	
	/*This display the save page of the admin section*/
	function display_guestbook_admin_save(){
		$output = '';
		$messageId = isset($_GET['messageId'])? $_GET['messageId']: '';
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
				
		}else{
					
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}
		
		$query = $database ->prepare("SELECT * FROM holding_Guestbook where message_id = ".$messageId);
		$query ->execute();
		$comment = $query ->fetch();
		
		if (is_numeric($messageId)){
			$sql = 'INSERT INTO guestbook (name, website, comment, posted_date, edited, edited_date, edited_by) 
				VALUES ("'.$comment['name'].'", "'.$comment['website'].'", "'.$comment['comment'].'", "'.$comment['posted_date'].'", '
				.(isset($comment['edited'])? $comment['edited']: 'NULL').', '
				.(isset($comment['edited_date'])? '"'.$comment['edited_date'].'"': 'NULL').', '.
				(isset($comment['edited_by'])? '"'.$comment['edited_by'].'"': 'NULL')
				.')';
			
			$output = $this ->display_guestbook_admin_table_top();
			$output .= $this ->display_guestbook_admin_table_row($comment['name'], $comment['website'], $comment['comment'], $comment['posted_date'], $comment['message_id']);
			$output .= '
		</table>
		
		<p>Are you sure?</p>
		<form action="guestbookAdmin.php?action=saveConfirm" method="post">
			<input type="hidden" name="sql" value="'.$this ->converthtmlToPlain($sql ).'" />
			<input type="hidden" name="sql2" value="DELETE FROM holding_Guestbook where message_id = '.$messageId.'" />
			<input type="submit" value="Yes" />
			<input type="button" value="No" onclick="location.href=
			\'guestbookAdmin.php\'"  />
		</form>
	</div>';
	
		}else{
			
			$output = $this ->display_guestbook_admin_go_back();
			
		}
		
		return $output;
	}
	
	/*This is the page that updates the database*/
	function display_guestbook_admin_save_confirm(){
		$output = '';
		
		
		$sql = isset($_POST['sql'])? $_POST['sql']: '';
		$sql2 = isset($_POST['sql2'])? $_POST['sql2']: '';
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
				
		}else{
					
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}
		
		$query = $database ->prepare($sql);
		$query2 = $database ->prepare($sql2);
		$count = isset($_POST['count'] )? $_POST['count'] : 1;
			
		try{
			$query ->execute();
			$query2 ->execute();
			$output = '
	<p>Comment'.($count > 1? 's':'').' has been sucessfully saved.</p>';
		} catch(PDOException $error){
			
			$output = '<p>Error with query. '.$error->getMessage().'</p>';
			
		}
		
		$output .= '
	<input type="button" onclick="location.href=\'guestbookAdmin.php\'"
	value="Contine"/>';
		
		return $output;
	}
	
	/*This display the save multi page of the admin section*/
	function display_guestbook_admin_save_multi(){
		$output ='';
		$i = 0;
		$count = 0;
		$messageIds = array();
		$comments = array();
		$selectedSql = ''; 
		$sql = ''; 
		$sql2  = '';
		
		while ($i < count($_POST['name'])){
			if ($_POST['selectedrow'][$i] === 'on'){
				$messageIds[$count] = $_POST['messageId'][$i];
				$count ++;
			}
			
			$i ++;
		}
		
		if ($count != 0){
			$selectedSql = 'SELECT * FROM holding_Guestbook WHERE';
			
			foreach ($messageIds as $messageId){
				$selectedSql .= ' message_id = '.$messageId.' OR'; 
			}
			
			$selectedSql = rtrim($selectedSql , " OR ");
			
			if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
			
				require("/var/www/websites/redesign2013/includes/connection.php");
					
			}else{
						
				require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
			}
			
			$query = $database ->prepare($selectedSql);
			$query ->execute();
			$comments = $query ->fetchAll();
			$output = $this ->display_guestbook_admin_table_top();
			$sql  = 'INSERT INTO guestbook (name, website, comment, posted_date, edited, edited_date, edited_by) VALUES';
			$sql2 = 'DELETE FROM holding_Guestbook WHERE message_id IN (';
			
			foreach ($comments as $comment){
				$output .= $this ->display_guestbook_admin_table_row($comment['name'], $comment['website'], $comment['comment'], $comment['posted_date'], $comment['message_id']);
				$sql .= '("'.$comment['name'].'", "'.$comment['website'].'", "'.$comment['comment'].'", "'.$comment['posted_date'].'", '
					.(isset($comment['edited'])? $comment['edited']: 'NULL').', '
					.(isset($comment['edited_date'])? '"'.$comment['edited_date'].'"': 'NULL').', '.
					(isset($comment['edited_by'])? '"'.$comment['edited_by'].'"': 'NULL')
					.'),';
				$sql2 .= $comment['message_id'].', ';
			
			}
			
			$sql = rtrim($sql, ",");
			$sql2 = rtrim($sql2, ", ");
			$sql  .= ';';
			$sql2 .= ')';
			
			$output .= '
		</table>
		
		<p>Are you sure?</p>
		<form action="guestbookAdmin.php?action=saveMultiConfirm" method="post">
			<input type="hidden" name="sql" value="'.$this ->converthtmlToPlain($sql).'" />
			<input type="hidden" name="sql2" value="'.$sql2.'" />
			<input type="hidden" name="count" value="'.$count.'" />
			<input type="submit" value="Yes" />
			<input type="button" value="No" onclick="location.href=
			\'guestbookAdmin.php\'"  />
		</form>
	</div';
	
		}else{
			$output = $this ->display_guestbook_admin_go_back();
		}
		
		return $output;
	}
	
	/*This display row of a table on various admin pages*/
	function display_guestbook_admin_table_row($name, $website, $comment, $postedDate, $messageId){
		$output ='';
		
		$output = '
			<tr>
				<td class="admin">'.$name.'</td>
				<td class="admin">'.$website.'</td>
				<td class="admin">'.$comment.'</td>
				<td class="admin">'.date('d/m/Y H:i:s', strtotime($postedDate)).'</td>
				<td class="admin">'.$messageId.'</td>
			</tr>';
		
		return $output;
	}
	
	/*This display  the table top on various admin pages*/
	function display_guestbook_admin_table_top(){
		$output ='';
		
		$output = '
	<div id="content">
		<table class="admin">
			<tr>
				<th class="admin">Name</th>
				<th class="admin">Website</th>
				<th class="admin">Comment</th>
				<th class="admin">Date Posted</th>
				<th class="admin">Message Id</th>		
			</tr>';
		
		return$output;
	}
	
	/*This displays the form for the gusetbook to add comments*/
	function display_guestbook_form(){
		$output = '';
		
		$output = '
<form id="guestbookForm"action="submitguestbook.php" method="post">
	<div style="float: right; width: 76%;">
		<p>To leave a comment in the guestbook, please fill in the form.
		<br />
		Adael sylw yn y llyfr gwestai, llenwch y ffurflen.
		</p>
		'. (isset($_GET["v"] )?$_GET["v"] == 'fail'? '<p class="white">Please check that you have enter your name and comment correctly.
		<br />
		Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad sylw yn gywir.</p>'  :   '<div id="error">
		<p class="white">Please check that you have enter your name and comment correctly.
		<br />Plis gwiriwch eich bod wedi rhoi eich enw a\'ch cyfeiriad sylw yn gywir.</p>
</div>':'' ).'
		<p class="white">* Required information / Gwybodaeth angenrheidiol</p>
		<div class="fieldline">
			<div class="fieldname">
				<label for="name">Name / Enw:</span><span class="white">*</span></label>
			</div>
			<div class="field">
				<input type="text" size="20" name="name"'.(isset($_SESSION["guestbookName"])?' value="'.$_SESSION["guestbookName"].'"':'').' />
			</div>
		</div>
		<div class="fieldline">
			<div class="fieldname">
				<label for>Website / Gwe safle:</label>
			</div>
			<div class="field">
				<input type="" size="20" name="website"'.(isset($_SESSION["guestbookWebsit"])?' value="'.$_SESSION["guestbookWebsit"].'"':'').' />
			</div>
		`</div>
		<div>
			<div>
				<label for="comment">Comment / Sylw:</span><span class="white">*</span></label>
				<br />
				<textarea cols="40" rows="5" name="comment">'.(isset($_SESSION["guestbookComment"])? $_SESSION["guestbookComment"]:'').'</textarea>
			</div>
		</div>
	</div>

	<div style="margin:0px auto; width:195px;">
		<input type="submit" name="submit" value="Submit /  Anfon" /> <input type="reset" name="reset" value="Reset / Clir" />
	</div>

</form>';
		
		return $output;
	}
	
	/*This displays the success message for adding a comment*/
	function guestbook_form_success($name, $website, $comment){
		$output = '';
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}
	
		$sql = sprintf("INSERT INTO holding_Guestbook(name, website, comment, posted_date) VALUES( %s, %s, %s, NOW())",
			$database ->quote($name),
			$database ->quote($website),
			$database ->quote($comment)
		);
	
		try{
		
			$query = $database ->prepare($sql);
			$query ->execute();
		} catch(PDOException $error){
		
			echo 'Error with query. '.$error->getMessage();
		}

		$output = "
	<p>Thank you for thecomment. It will added to the guestbook after it has been checked by the  moderator.

	Diolch am y sylw. Bydd yn ychwanegu at y llyfr gwestai ar &ocirc;l iddo gael ei wirio gan y safonwr.</p>";
		
		return $output;
	}
	
	/*This starts up the variables for displaying the guestbook*/
	function init_guestbook(){
		$page = isset($_GET["page"])?$_GET["page"]: 1;
		$page = is_numeric($page)? $page: 1;
		
		if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}

		$query = $database ->prepare("SELECT COUNT(*) FROM guestbook");
		$query ->execute();
		$results = $query ->fetch();
		$countRows = $results["COUNT(*)"];

		$rowsPerPage = 10;
		$totalPages = ceil($countRows / $rowsPerPage);
		

		if ($page < 1){
			$page = 1;
		}
		
		if ($page > $totalPages){
			$page = $totalPages;
		}
		
		$offset = ($page - 1) * $rowsPerPage;
		
		$query = $database ->prepare("SELECT * FROM guestbook ORDER BY message_id DESC LIMIT ".$offset.",".$rowsPerPage);
		$query  ->execute();

		$guestbookMessages = $query ->fetchAll();

		$noofrows = count($guestbookMessages);
		$noofrows--;
		
		$this ->guestbookMessages = $guestbookMessages;
		$this ->noofrows = $noofrows; 
		$this ->page = $page;
		$this ->totalPages = $totalPages;
		
		
	}
	
	/*This displays the page section of the guestbook*/
	function page_section(){
		$page = $this ->page;
		$totalPages = $this ->totalPages;
		$output = '';
		
		$output .= '
	<div class="pageSelector">'."\n";

		$range = 3;

		if ($page > 1){
			$output .= '		<a class="normal" href="'.$filename.'?page=1">&lt;&lt;</a>'."\n";
			$prevPage = $page -1;
			$output .= '		<a class="normal" href="'.$filename.'?page='.$prevPage.'">&lt;</a>'."\n";
		}

		for ($i = ($page - $range); $i < (($page + $range) + 1); $i++){
			if (($i > 0) && ($i <= $totalPages)){
				if ($i == $page){
					if ($i == $totalPages){
						$output .= '		<span class="bold">'.$i.'</span>'."\n";
					}else{
						$output .= '		<span class="bold">'.$i.'|</span>'."\n";
					}
				}else{
					if ($i == $totalPages){
						$output .= '		<a class="normal" href="'.$filename.'?page='.$i.'">'.$i.'</a>'."\n";
					}else{
						$output .= '		<a class="normal" href="'.$filename.'?page='.$i.'">'.$i.'</a>|'."\n";
					}
				}
			}
		}

		if ($page != $totalPages){
			$nextPage =  $page + 1;
			$output .= '		<a class="normal" href="'.$filename.'?page='.$nextPage.'">&gt;</a>'."\n";
			$output .= '		<a class="normal" href="'.$filename.'?page='.$totalPages.'">&gt;&gt;</a>'."\n";
		}

		$output .= '
	</div>';
		
		return $output;
		
	}
	
	/*This truncate a sentence based on length*/
	function truncate($string, $length){
		$output = '';
		
		if (strlen($string) > $length){
			$output = substr($string, 0, $length);
			$output .= '...';
		}else{
			$output = $string;
		}
		
		return $output;
	}
	
	/**/
	/*function (){
		
		
		
	}*/
}
?>