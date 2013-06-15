<?php include '../includes/header.php'; ?>

<body>
<div class="container">
<div id="menu">
	<ul class="menu">
		<?php include '../includes/menu.html';?>
	</ul>
</div>

<?=getprofile($profile_id)?>



<?php echo backButton($filename ); ?>


</div>



</body>

</html>