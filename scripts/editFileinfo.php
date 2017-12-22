<?php 
/*@Author; Christine A. Black
@Version:0.6

Version 0.6 - Changed the db connectuo into a class and fixed error wirh keywords.
Version 0.5 -  Seprated pages table into two.
Version 0.4 -  Added twiter fields.
Version 0.3 -  Added the sitemap field and corrected the mysql query.
Version 0.2 -  Fixed php warning errors.
Version 0.1 - Added editFileInfo.php to site.*/
/*Get the action from the url*/
$action = isset($_GET["action"])? $_GET["action"]: '';

/*Includes the header class files and database connections*/
include '../includes/header.php'; 

/*A function to convert html into plain text*/
function converthtmlToPlain($code){
	
	$output = htmlentities($code);
	
	return $output;

}

?>

<body>
<style>
table{
  width: 520px;
  table-layout: fixed;
  border-collapse: collapse;
}
th, td{
  font-size: smaller;
  width: 60px;
  
}

th:nth-child(1), td:nth-child(1){
  border-left: #fff solid 3px;
}
th:nth-child(4),td:nth-child(4){
   border-right: #fff solid 3px;
}
th:nth-child(5){
   width: 55px;
}

td:nth-child(5){
   border-right: #fff solid 1px;
   width: 55px;
}

th:nth-child(1), th:nth-child(2), th:nth-child(3), th:nth-child(4){
  border-top: #fff solid 3px;
  border-bottom: #fff solid 3px;
}

tbody > tr:last-child > td:nth-child(1),
tbody tr:last-child td:nth-child(1),
tbody > tr:last-child > td:nth-child(2), 
tbody tr:last-child td:nth-child(2),
tbody > tr:last-child > td:nth-child(3),
tbody tr:last-child td:nth-child(3),
tbody > tr:last-child > td:nth-child(4),
tbody tr:last-child td:nth-child(4){
  border-bottom: #fff solid 3px;
}

td{
  border-top: #fff solid 1px;
  border-bottom: #fff solid 1px;
}

tbody tr:hover, tbody > tr:hover{
  background-color: #FFFFFF;
  color: #800080;
}
</style>

<div class="container">
<div id="menu">
</div>

<div id="content">
	<?php 
	/*Display differnt pages base on acyopn variable*/
	switch($action){	
		case 'update':
			/*This is the page that updates the database*/
			
			/*Gets data from previous page*/
			$sql = isset($_POST["sql"])?$_POST["sql"]:'';
			$countEdits = isset($_POST["countEdit"])?$_POST["countEdit"]:0;
			
			/*Updages the database if there has been a change*/
			if ($countEdits != 0){
				
				$query = $database ->prepare($sql);
				$query ->execute();
			
			}
			
			/*Displays a message*/
			echo '<p>Page has been sucessfully updated.</p>
			<input type="button" onclick="location.href=\'editFileinfo.php\'"
			value="Contine"/>';
		
		break;
		case 'save':
			/*This page confirms if the user wants to makes change(s)*/
			
			/*Gets the file from url*/
			$file = isset($_GET["file"])?$_GET["file"] : '';
			
			/*Displays the data from the inputs from previous page*/
			echo '
				<div class="fieldline">
					<div class="fieldname"><p>File name:</p></div>
					<div class="field"><p>'.$file.'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Title:</p></div>
					<div class="field"><p>'.$_POST["title"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Keywords:</p></div>
					<div class="field"><p>'.$_POST["keywords"].'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Description (English):</p></div>
					<div class="field"><p>'.$_POST["descriptionen"].'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Description (Werlsh):</p></div>
					<div class="field"><p>'.$_POST["descriptioncymraeg"].'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook title:</p></div>
					<div class="field"><p>'.$_POST["facebooktitle"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook description:</p></div>
					<div class="field"><p>'.$_POST["facebookdescription"].'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook image:</p></div>
					<div class="field"><p>'.$_POST["facebookimage"].'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook url:</p></div>
					<div class="field"><p>'.$_POST["facebookurl"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter card type:</p></div>
					<div class="field"><p>'.$_POST["twittercard"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter site:</p></div>
					<div class="field"><p>'.$_POST["twittersite"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter title:</p></div>
					<div class="field">
						<p>'.$_POST["twittertitle"].'</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter description:</p></div>
					<div class="field"><p>'.$_POST["twitterdescription"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitteri mage:</p></div>
					<div class="field"><p>'.$_POST["twitterimage"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>What\'s new (English):</p></div>
					<div class="field"><p>'.$_POST["whatnewenglish"].'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>What\'s new (Welsh):</p></div>
					<div class="field"><p>'.$_POST["whatnewcymraeg"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Included in new?</p></div>
					<div class="field"><p> ' .($_POST["includedinnew"] == 1?'Yes':'No').'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>News order:</p></div>
					<div class="field"><p>'.$_POST["newsortorder"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Included in sitemap.xml?</p></div>
					<div class="field"><p> ' .($_POST["includedinsitemap"] == 1?'Yes':'No').'</p></div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>html5?</p></div>
					<div class="field"><p> ' .($_POST["html5"] == 1?'Yes':'No').'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Html code:</p></div>
					<div class="field"><p>'.converthtmlToPlain($_POST["htmlcode"]).'</p></div>
				</div>
				<div class="clear"></div>';
			
			/*Creates the query base on yhe foelds that have been change*/
			$sql = "UPDATE pages, social_media SET";
			$countEdits = 0;
			
			if ( $_POST["titleH"]  !==  $_POST["title"]){
				$sql .= ' title = "'.$_POST["title"].'",';
				$countEdits ++;
			}
			
			if ($_POST["keywordsH"] !== $_POST ["keywords"] ){
				$sql .= ' keywords = "'. $_POST ["keywords"].'",';
				$countEdits ++;
			}
			
			if ($_POST["descriptionenH"] !== $_POST["descriptionen"]){
				$sql .= ' descriptionen = "'.$_POST["descriptionen"].'",';
				$countEdits ++;
			}
			
			if ($_POST["descriptioncymraegH"] !== $_POST["descriptioncymraeg"]){
				$sql .= ' descriptioncymraeg = "'.$_POST["descriptioncymraeg"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebooktitleH"] !== $_POST["facebooktitle"]){
				$sql .= ' social_media.facebooktitle = "'.$_POST["facebooktitle"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebookdescriptionH"] !== $_POST["facebookdescription"]){
				$sql .= ' social_media.facebookdescription = "'.$_POST["facebookdescription"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebookimageH"] !== $_POST["facebookimage"]){
				$sql .= ' social_media.acebookimage = "'.$_POST["facebookimage"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebookurlH"] !== $_POST["facebookurl"]){
				$sql .= ' social_media.facebookurl = "'.$_POST["facebookurl"].'",';
				$countEdits ++;
			}
			
			if ( $_POST["twittercardH"]  !==  $_POST["twittercard"]){
				$sql .= ' social_media.twittercard = "'.$_POST["twittercard"].'",';
				$countEdits ++;
			}
			
			if ( $_POST["twittersiteH"]  !=  $_POST["twittersite"]){
				$sql .= ' social_media.twittersite = "'.$_POST["twittersite"].'",';
				$countEdits ++;
			}
			
			if ( $_POST["twittertitleH"]  !==  $_POST["twittertitle"]){
				$sql .= ' social_media.twittertitle = "'.$_POST["twittertitle"].'",';
				$countEdits ++;
			}
			
			if ( $_POST["twitterdescriptionH"]  !==  $_POST["twitterdescription"]){
				$sql .= ' social_media.twitterdescription = "'.$_POST["twitterdescription"].'",';
				$countEdits ++;
			}
			
			if ( $_POST["twitterimageH"]  !==  $_POST["twitterimage"]){
				$sql .= ' social_media.twitterimage = "'.$_POST["twitterimage"].'",';
				$countEdits ++;
			}
			
			if ($_POST["whatnewenglishH"] !== $_POST["whatnewenglish"]){
				$sql .= ' whatnewenglish`= "'.$_POST["whatnewenglish"].'",';
				$countEdits ++;
			}
			
			if ($_POST["whatnewcymraegH"] !== $_POST["whatnewcymraeg"]){
				$sql .= ' whatnewcymraeg = "'.$_POST["whatnewcymraeg"].'",';
				$countEdits ++;
			}
			
			if ($_POST["includedinnewH"] !== $_POST["includedinnew"]){
				$sql .= ' includedinnew = "'.$_POST["includedinnew"].'",';
				$countEdits ++;
			}
			
			if ($_POST["newsorderH"] !== $_POST["newsorder"]){
				$sql .= ' newsorder = "'.$_POST["newsorder"].'",';
				$countEdits ++;
			}
			
			if ($_POST["html5H"] !== $_POST["html5"]){
				$sql .= ' html5 = "'.$_POST["html5"].'",';
				$countEdits ++;
			}
			
			if ($_POST["includedinsitemapH"] !== $_POST["includedinsitemap"]){
				$sql .= '  includedinsitemap = "'.$_POST["includedinsitemap"].'",';
				$countEdits ++;
			}
			
			if ($_POST["htmlcodeH"] !== $_POST["htmlcode"]){
				$sql .= ' htmlcode = "'.$_POST["htmlcode"].'",';
				$countEdits ++;
			}
			
			if ($countEdits != 0){
				$sql = rtrim($sql,',');
				$sql .= ' WHERE pages.filename = social_media.filename
					AND pages.filename = "'.$file.'"';
			}
			
			/*Passes data to the next page*/
			?>
			
			<form action="editFileinfo.php?action=update&file=<?php echo $file?>" method="post">
				<input type="hidden" name="sql" value = "<?php echo converthtmlToPlain($sql)?>" />
				<input type="hidden" name="countEdit" value = "<?php echo $countEdits?>" />
			
				<input type="submit" value="Save"/>
				<input type="button" onclick="location.href='editFileinfo.php?action=edit&file=<?php echo $file?>'"
			value="Cancel"/>
				
			</form>
			
		<?php
		break;
		case 'edit':
			/*This diplay the edit page*/
			
			/*Gets file from url*/
			$file = isset($_GET["file"])?$_GET["file"] : '';
		?>
		
		<form action="editFileinfo.php?action=save&file=<?php echo $file?>" method="post">
			
		
		<?php
			
			
			/*Gets detaols from the database*/
			$sql = 'SELECT pages.filename,  title,  keywords, descriptionen, descriptioncymraeg,
			social_media.facebooktitle, social_media.facebookdescription, social_media.facebookimage, 
			social_media.facebookurl, social_media.twittercard, social_media.twittersite, 
			social_media.twittertitle, social_media.twitterdescription, social_media.twitterimage, 
			whatnewenglish, whatnewcymraeg, includedinnew, newsortorder, includedinsitemap, html5,
			datelastmodified, htmlcode
			FROM pages, social_media  
			WHERE pages.filename = social_media.filename
			AND pages.filename = "'.$file.'"';
			
			$query = $database ->prepare($sql );
			$query ->execute();
			
			$fileInfo = $query ->fetch();
			
			/*Display the form*/
			echo '
				<div class="fieldline">
					<div class="fieldname"><p>File name:</p></div>
					<div class="field"><p>'.$fileInfo ["filename"].'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Title:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="titleH" value = "'.$fileInfo["title"] .'" />
							<input type="text" name="title" value = "'.$fileInfo["title"] .'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Keywords:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="keywordsH" value = "'.$fileInfo["keywords"].'" />
							<textarea name="keywords" >'.$fileInfo["keywords"].'</textarea>
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Description (English):</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="descriptionenH" value = "'.$fileInfo["descriptionen"].'" />
							<input type="text" name="descriptionen" value ="'.$fileInfo["descriptionen"].'"  />
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Description (Werlsh):</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="descriptioncymraegH" value = "'.$fileInfo["descriptioncymraeg"].'" />
							<input type="text" name="descriptioncymraeg" value = "'.$fileInfo["descriptioncymraeg"].'" />
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook title:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="facebooktitleH" value = "'.$fileInfo["facebooktitle"].'" />
							<input type="text" name="facebooktitle" value =  "'.$fileInfo["facebooktitle"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook description:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="facebookdescriptionH" value = "'.$fileInfo["facebookdescription"].'" />
							<input type="text" name="facebookdescription" value = "'.$fileInfo["facebookdescription"].'" />
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook image:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="facebookimageH" value = "'.$fileInfo["facebookimage"].'" />
							<input type="url" name="facebookimage" value = "'.$fileInfo["facebookimage"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Facebook url:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="facebookurlH" value = "'.$fileInfo["facebookurl"].'" />
							<input type="url" name="facebookurl" value = "'.$fileInfo["facebookurl"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter card type:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="twittercardH" value = "'.$fileInfo["twittercard"].'" />
							<select name="twittercard">
								<option value="summary" ' .($fileInfo["twittercard"] == "summary"?'selected':'').'>Summary</option>
								<option value="summary_large_image" ' .($fileInfo["twittercard"] == "summary_large_image"?'selected':'').'>Summary with Large Image</option>
								<option value="app" ' .($fileInfo["twittercard"] == "app"?'selected':'').'>App</option>
							</select>
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter site:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="twittersiteH" value = "'.$fileInfo["twittersite"].'" />
							<input type="text" name="twittersite" value = "'.$fileInfo["twittersite"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter title:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="twittertitleH" value = "'.$fileInfo["twittertitle"].'" />
							<input type="text" name="twittertitle" value = "'.$fileInfo["twittertitle"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitter description:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="twitterdescriptionH" value = "'.$fileInfo["twitterdescription"].'" />
							<input type="text" name="twitterdescription" value = "'.$fileInfo["twitterdescription"].'" />
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Twitteri mage:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="twitterimageH" value = "'.$fileInfo["twitterimage"].'" />
							<input type="url" name="twitterimage" value = "'.$fileInfo["twitterimage"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>What\'s new (English):</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="whatnewenglishH" value = "'.$fileInfo["whatnewenglish"].'" />
							<input type="text" name="whatnewenglish" value = "'.$fileInfo["whatnewenglish"].'" />
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>What\'s new (Welsh):</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="whatnewcymraegH" value = "'.$fileInfo["whatnewcymraeg"].'" />
							<input type="text" name="whatnewcymraeg" value ="'.$fileInfo["whatnewcymraeg"].'" />
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Included in new?</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="includedinnewH" value = "'.$fileInfo["includedinnew"].'" />
							<select name="includedinnew">
								<option value="1" ' .($fileInfo["includedinnew"] == 1?'selected':'').'>Yes</option>
								<option value="0" ' .($fileInfo["includedinnew"] == 0?'selected':'').'>No</option>
							</select>
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>News order:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="newsorderH" value = "'.$fileInfo["newsortorder"].'" />
							<input type="text" name="newsorder" value = "'.$fileInfo["newsortorder"].'" />
						</p>
					</div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Included in sitemap.xml?</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="includedinsitemapH" value = "'.$fileInfo["includedinsitemap"].'" />
							<select name="includedinsitemap">
								<option value="1" ' .($fileInfo["includedinsitemap"] == 1?'selected':'').'>Yes</option>
								<option value="0" ' .($fileInfo["includedinsitemap"] == 0?'selected':'').'>No</option>
							</select>
						</p>
					</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>html5?</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="html5H" value = "'.$fileInfo["html5"].'" />
							<select name="html5">
								<option value="1" ' .($fileInfo["html5"] == 1?'selected':'').'>Yes</option>
								<option value="0" ' .($fileInfo["html5"] == 0?'selected':'').'>No</option>
							</select>
						</p>
					</div>
				</div>
				
				<div class="fieldline">
					<div class="fieldname"><p>Date last modified:</p></div>
					<div class="field"><p></p>'.$fileInfo["datelastmodified"].'</div>
				</div>
				<div class="clear"></div>
				<div class="fieldline">
					<div class="fieldname"><p>Html code:</p></div>
					<div class="field">
						<p>
							<input type="hidden" name="htmlcodeH" value = "'.converthtmlToPlain($fileInfo["htmlcode"]).'" />
							<textarea name="htmlcode">'.$fileInfo["htmlcode"].'</textarea>
						</p>
					</div>
				</div>
				
				<div class="clear"></div>
				
				<input type="submit" 
			value="Save"/>
				
			</form>
					';
			
		
		break;
		default:
		/*This page displays a table listing files and their keywords and their description*/
	?>
	
	<form action="editFileinfo.php" method="">
	<table>
	<thead>
		<tr>
			<th>File Name</th>
			<th>Title</th>
			<th>Description (English)</th>
			<th>Description (Werlsh)</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php


/*Gets data from the database*/ 
$sql = 'SELECT * FROM `pages` ';

$query = $database ->prepare($sql );
$query ->execute();

/*Builds the table rows with the data from the database*/
while ($fileinfo = $query ->fetch()){
	echo '
		<tr>
			<td class="">'.$fileinfo["filename"].'</td>
			<td>'.$fileinfo ["title"].'</td>
			<td>'.$fileinfo["descriptionen"].'</td>
			<td>'.$fileinfo["descriptioncymraeg"].'</td>
			<td><input type="button" 
			onclick="location.href=
			\'editFileinfo.php?action=edit&file='.$fileinfo["filename"].'\'"
			value="Edit"/></td>
		</tr>';

}

?>
	</tbody>
	</table>
	</form>
	<?php
	break;
	}
	?>

</div>

<?php 
/*Includes the footer*/
include '../includes/footer.php'; ?>

</div>



</body>

</html>