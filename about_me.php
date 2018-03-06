<?php 
$lang = isset($_GET["lang"])? $_GET["lang"]:  'en' ;
$page = isset($_GET["page"])?  $_GET["page"]: 1 ;

include 'includes/header.php'; 
include 'includes/lang/en.about_me.php'; 
?>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include 'includes/menu.html';?>
	</ul>
</div>

<?php
switch($page){ 
	case 2:
		echo PAGE_TWO_TEXT.'
<div style="width: 150px; float: right; padding: 10px;">
	<a class="normal" href="'.$page1_link .'">'.PAGE_ONE.'</a> | '.PAGE_TWO.'
</div>
		';
		
	break;
	case 1;
	default:
		echo PAGE_ONE_TEXT.'
<div style="width: 150px; float: right; padding: 10px;">
	'.PAGE_ONE.' | <a class="normal" href="'.$page2_link .'">'.PAGE_TWO.'</a>
</div>
		';
	break;
}
?>

<?php include 'includes/footer.php'; ?>

</div>



</body>

</html>