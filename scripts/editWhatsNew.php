<?php
/*@Author; Christine A. Black
@Version:0.1

Version 0.1 - Added editFileInfo.php to site.*/
/*Includes the header class files and database connections*/
include '../includes/header.php'; 

function word_wrap($string, $length){
	$output = '';
		
		if (strlen($string) > $length){
			$count = ceil((strlen($string) /  $length));
			$i = 0;
			
			while ($i < $count){
				$startPoint = $length * $i;
				$output .= substr($string, $startPoint, $length);
				
				if ($i  != ($count - 1)){
					$output .= "\n".'<br />'."\n";
				}
				$i ++;
			}
			
		}else{
			$output = $string;
		}
		
		return $output;
}

?>
<body>
<link rel="stylesheet" type="text/css" href="/css/admin.css?v0.1" />
<script src="/includes/javascript/editWhatsNew.js"></script>
<div class="container">
<div id="menu">
</div>

<div id="content">

<?php

$sql = 'SELECT `filename`, `title`, `whatnewenglish`, `whatnewcymraeg`, `datelastmodified`, `includedinnew`, `newsortorder`FROM `pages` 
WHERE `includedinnew`= 1
	ORDER BY `newsortorder` DESC';
$query = $database ->prepare($sql );
$query ->execute();
$currentNewPages= $query ->fetchAll();
$sql = 'SELECT `filename`, `title`, `whatnewenglish`, `whatnewcymraeg`, `datelastmodified`, `includedinnew`, `newsortorder`FROM `pages` 
	ORDER BY `datelastmodified` DESC
	LIMIT 16';
$query = $database ->prepare($sql);
$query ->execute();
$recentlyUpdatedpages = $query ->fetchAll();
$sql = 'SELECT `filename`, `title`, `whatnewenglish`, `whatnewcymraeg`, `datelastmodified`, `includedinnew`, `newsortorder`FROM `pages` 
	ORDER BY `datelastmodified` DESC';
$query = $database ->prepare($sql);
$query ->execute();
$allPages = $query ->fetchAll();
?>
	
	<fieldset id="current-order">
		<legend>Currend Order:</legend>
		<ul id="current-new-pages">
<?php
	foreach ($currentNewPages  as $currentNewPage){
		//print_r($currentNewPage);
		//die();
		echo '
			<li class="button"><span>'.word_wrap($currentNewPage['filename'], 40).'</span>    <button class="edit-button"> edit</button>
				<div class="edit">
					<label>Filename: </label><p class="filename">'.$currentNewPage['filename'].'</p>
					<label>Title: </label><p>'.$currentNewPage['title'] .'</p>
					<label for="whatnewenglish">What\'s new (English): </label>
					<input type="hidden" class="whatnewenglishH" name="whatnewenglishH" value="'.$currentNewPage['whatnewenglish'].'"  />
					<input type="input" class="whatnewenglish" name="whatnewenglish" size="65" value="'.$currentNewPage['whatnewenglish'].'"  />
					<br />
					<label for="whatnewcymraeg">What\'s new (Welsh):&nbsp;&nbsp;      </label>
					<input type="hidden" class="whatnewcymraegH" name="whatnewcymraegH" value="'.$currentNewPage['whatnewcymraeg'].'"  />
					<input type="input" class="whatnewcymraeg" name="whatnewcymraeg" size="65" value="'.$currentNewPage['whatnewcymraeg'].'"  />
					<input type="hidden" class="newsorderH" name="newsorderH" value="'.$currentNewPage['newsortorder'].'" />
					<br />
					<br />
					<div style="width: 109px; margin:0 auto;">
						<button class="edit-save">Save</button> <button class="edit-cancel">Cancel</button>
					</div>
				</div>
			</li>';
	}
?>
		</ul>
	</fieldset>
	<fieldset id="recently-updated">
		<legend>Recently Updated Pages:</legend>
		<ul id="recently-updated-pages">
<?php		
	foreach ($recentlyUpdatedpages as $recentlyUpdatedpage){
		echo '
			<li class="button"><span>'.word_wrap($recentlyUpdatedpage['filename'], 40).'</span>    <button class="edit-button"> edit</button>
				<div class="edit">
					<label>Filename: </label><p class="filename">'.$recentlyUpdatedpage['filename'].'</p>
					<label>Title: </label><p>'.$recentlyUpdatedpage['title'] .'</p>
					<label for="whatnewenglish">What\'s new (English): </label>
					<input type="hidden" class="whatnewenglishH" name="whatnewenglishH" value="'.$recentlyUpdatedpage['whatnewenglish'].'"  />
					<input type="input" class="whatnewenglish" name="whatnewenglish" size="65" value="'.$recentlyUpdatedpage['whatnewenglish'].'"  />
					<br />
					<label for="whatnewcymraeg">What\'s new (Welsh):&nbsp;&nbsp;      </label>
					<input type="hidden" class="whatnewcymraegH" name="whatnewcymraegH" value="'.$recentlyUpdatedpage['whatnewcymraeg'].'"  />
					<input type="input" class="whatnewcymraeg" name="whatnewcymraeg" size="65" value="'.$recentlyUpdatedpage['whatnewcymraeg'].'"  />
					<input type="hidden" class="newsorderH" name="newsorderH" value="'.$recentlyUpdatedpage['newsortorder'].'" />
					<br />
					<br />
					<div style="width: 109px; margin:0 auto;">
						<button class="edit-save">Save</button> <button class="edit-cancel">Cancel</button>
					</div>
				</div>
			</li>';
	}
?>
		</ul>
	</fieldset>

</div>

<div id="controls">
	<div id="save-dialog">
		<p>Are you sure?</p>
		<div>
			<button id="save-confirm">Save</button>
			<button id="save-cancel">Cancel</button>
		</div>
	</div>
	<div id="bin-container">
		<span id="bin-close">X</span>
		<ul id="bin">
			<li class="button"></li>
		</ul>
	</div>
	<div style="width:100px; margin: 0px auto;">
		<button id="save-button">Save</button>
		<button id="bin-button">Bin</button>
	</div>
</div>
<div id="all-pages-container">
	<div style="padding: 0px 10px 0px; height: 100%; overflow-y: auto; margin-left:36px">
		<ul id="all-pages">
<?php
	foreach ($allPages as $allPage){
		echo '
			<li class="button"><span>'.word_wrap($allPage['filename'], 17).'</span>    <button class="edit-button"> edit</button>
				<div class="edit">
					<label>Filename: </label><p class="filename">'.$allPage['filename'].'</p>
					<label>Title: </label><p>'.$allPage['title'] .'</p>
					<label for="whatnewenglish">What\'s new (English): </label>
					<input type="hidden" class="whatnewenglishH" name="whatnewenglishH" value="'.$allPage['whatnewenglish'].'"  />
					<input type="input" class="whatnewenglish" name="whatnewenglish" size="65" value="'.$allPage['whatnewenglish'].'"  />
					<br />
					<label for="whatnewcymraeg">What\'s new (Welsh):&nbsp;&nbsp;      </label>
					<input type="hidden" class="whatnewcymraegH" name="whatnewcymraegH" value="'.$allPage['whatnewcymraeg'].'"  />
					<input type="input" class="whatnewcymraeg" name="whatnewcymraeg" size="65" value="'.$allPage['whatnewcymraeg'].'"  />
					<input type="hidden" class="newsorderH" name="newsorderH" value="'.$allPage['newsortorder'].'" />
					<br />
					<br />
					<div style="width: 109px; margin:0 auto;">
						<button class="edit-save">Save</button> <button class="edit-cancel">Cancel</button>
					</div>
				</div>
			</li>';
	}
?>
		</ul>
	</div>
</div>
<?php 
/*Includes the footer*/
include '../includes/footer.php'; ?>

</div>

</body>

</html>