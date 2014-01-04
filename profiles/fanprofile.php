<?php 
include '../includes/header.php'; ?>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include '../includes/menu.html';?>
	</ul>
</div>

<h1><?php echo isset($fileinfo["title"])?$fileinfo["title"]:'Error'; ?></h1>

<?php echo getprofile($profile_id);?>

<?php echo backButton($filename ); ?>

</div>

</body>

</html>