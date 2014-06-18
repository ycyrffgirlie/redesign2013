<?php 
include '../includes/header.php'; ?>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include '../includes/menu.html';?>
	</ul>
</div>

<?php echo getprofile($profile_id,$fileinfo["title"]);?>

<?php echo backButton($filename ); ?>

<?php include '../includes/footer.php'; ?>

</div>

</body>

</html>