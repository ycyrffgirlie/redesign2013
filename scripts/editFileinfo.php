<?php 
/*@Author; Christine A. Black
@Version:0.1

Version 0.1 - Added editFileInfo.php to site.*/
include '../includes/header.php'; 
$action = isset($_GET["action"])? $_GET["action"]: '';

if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
			require("/var/www/websites/redesign2013/includes/connection.php");
		
		}else{
			
			require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
		}

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
	switch($action){	
		case 'update':
			
			$sql = isset($_POST["sql"])?$_POST["sql"]:'';
			$countEdits = isset($_POST["countEdit"])?$_POST["countEdit"]:0;
			
			
			if ($countEdits != 0){
				
				$query = $database ->prepare($sql);
				$query ->execute();
			
			}
			
			echo '<p>Page has been sucessfully updated.</p>
			<input type="button" onclick="location.href=\'editFileinfo.php\'"
			value="Contine"/>';
		
		break;
		case 'save':
			
			$file = isset($_GET["file"])?$_GET["file"] : '';
			
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
					<div class="fieldname"><p>html5?</p></div>
					<div class="field"><p> ' .($_POST["html5"] == 1?'Yes':'No').'</p></div>
				</div>
				<div class="fieldline">
					<div class="fieldname"><p>Html code:</p></div>
					<div class="field"><p>'.converthtmlToPlain($_POST["htmlcode"]).'</p></div>
				</div>
				<div class="clear"></div>';
			
			$sql = "UPDATE `pages` SET";
			$countEdits = 0;
			
			if ( $_POST["titleH"]  !=  $_POST["title"]){
				$sql .= '`title` = "'.$_POST["title"].'",';
				$countEdits ++;
			}
			
			if ($_POST["keywordsH"] != $_POST ["keywords"] ){
				$sql .= '`keywords` = "'. $_POST ["keywords"].'",';
				$countEdits ++;
			}
			
			if ($_POST["descriptionenH"] != $_POST["descriptionen"]){
				$sql .= '`descriptionen` = "'.$_POST["descriptionen"].'",';
				$countEdits ++;
			}
			
			if ($_POST["descriptioncymraegH"] != $_POST["descriptioncymraeg"]){
				$sql .= '`descriptioncymraeg` = "'.$_POST["descriptioncymraeg"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebooktitleH"] != $_POST["facebooktitle"]){
				$sql .= '`facebooktitle` = "'.$_POST["facebooktitle"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebookdescriptionH"] != $_POST["facebookdescription"]){
				$sql .= '`facebookdescription` = "'.$_POST["facebookdescription"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebookimageH"] != $_POST["facebookimage"]){
				$sql .= '`facebookimage` = "'.$_POST["facebookimage"].'",';
				$countEdits ++;
			}
			
			if ($_POST["facebookurlH"] != $_POST["facebookurl"]){
				$sql .= '`facebookurl` = "'.$_POST["facebookurl"].'",';
				$countEdits ++;
			}
			
			if ($_POST["whatnewenglishH"] != $_POST["whatnewenglish"]){
				$sql .= '`whatnewenglish` = "'.$_POST["whatnewenglish"].'",';
				$countEdits ++;
			}
			
			if ($_POST["whatnewcymraegH"] != $_POST["whatnewcymraeg"]){
				$sql .= '`whatnewcymraeg` = "'.$_POST["whatnewcymraeg"].'",';
				$countEdits ++;
			}
			
			if ($_POST["includedinnewH"] != $_POST["includedinnew"]){
				$sql .= '`includedinnew` = "'.$_POST["includedinnew"].'",';
				$countEdits ++;
			}
			
			if ($_POST["newsorderH"] != $_POST["newsorder"]){
				$sql .= '`newsorder` = "'.$_POST["newsorder"].'",';
				$countEdits ++;
			}
			
			if ($_POST["html5H"] != $_POST["html5"]){
				$sql .= '`html5` = "'.$_POST["html5"].'",';
				$countEdits ++;
			}
			
			if ($_POST["htmlcodeH"] != $_POST["htmlcode"]){
				$sql .= '`htmlcode` = "'.$_POST["htmlcode"].'",';
				$countEdits ++;
			}
			
			if ($countEdits != 0){
				$sql = rtrim($sql,',');
			}
			
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
		
			$file = isset($_GET["file"])?$_GET["file"] : '';
		?>
		
		<form action="editFileinfo.php?action=save&file=<?php echo $file?>" method="post">
			
		
		<?php
			
			
			
			$sql = 'SELECT * FROM `pages` WHERE `filename`= "'.$file.'"';
			$query = $database ->prepare($sql );
			$query ->execute();
			
			$fileInfo = $query ->fetch();
			
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
							<textarea name="keywords" >'.$fileInfo["keywords"].' </textarea>
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



$sql = 'SELECT * FROM `pages` ';

$query = $database ->prepare($sql );
$query ->execute();

while ($fileinfo = $query ->fetch()){
	echo '
		<tr>
			<td class="">'.$fileinfo[filename].'</td>
			<td>'.$fileinfo [title].'</td>
			<td>'.$fileinfo[descriptionen].'</td>
			<td>'.$fileinfo[descriptioncymraeg].'</td>
			<td><input type="button" 
			onclick="location.href=
			\'editFileinfo.php?action=edit&file='.$fileinfo[filename].'\'"
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

<?php include '../includes/footer.php'; ?>

</div>



</body>

</html>