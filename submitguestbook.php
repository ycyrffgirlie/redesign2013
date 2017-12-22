<?php 
include 'includes/header.php'; 
 include 'includes/class/guestbook.class.php';
 
 $guestbook = new guestbook;
 
 if (!isset($_SESSION)){
	session_name('cyrffRedesign');
	session_start();
}

if (isset($_POST["name"] )){
	if ($_POST["name"] !=NULL && $_POST["name"] != ' ' &&  $_POST["comment"]  != NULL && $_POST["comment"] != ' ' ){
		
		$name = $_POST["name"];
		$website = $_POST["website"];
		$comment = $_POST["comment"];
		$posted_date = date('Y-m-d H:i:s'); 
		$_GET["v"] = '';
	}else{
		
		$_SESSION["guestbookName"] = $_POST["name"];
		$_SESSION["guestbookWebsit"] = $_POST["website"];
		$_SESSION["guestbookComment"] = $_POST["comment"];
		header('Location:http://'.$_SERVER["HTTP_HOST"].'/submitguestbook.php?v=fail', true, 302);
	}
}
?>

<body>
<script src="/includes/javascript/guestbook.js"></script>
<div class="container">
<div class="view-top">
	<a class="normal" href="guestbook.html">View Guestbook / Gweld y LLyfr Gwestai</a>
</div>
<div class="clear"></div>
<div id="menu">
	<ul class="menu">
		<?php include 'includes/menu.html';?>
	</ul>
</div>

<h1>Sign Guestbook / Arwyddio'r LLyfr Gwestai</h1>

<?php
if (isset($_POST["name"]) &&  $_GET["v"] != 'fail'){

	echo $guestbook ->guestbook_form_success($name, $website, $comment, $database);
	
}else{
	
	echo $guestbook ->display_guestbook_form();
}
?>


<a class="buttonlink" href="guestbook.html">
	<div class="view-button">
		<span class="button">
			View Guestbook / 
			<br />
			Gweld y LLyfr Gwestai
		</span>
	</div>
</a>

<?php include 'includes/footer.php'; ?>

</div>


</body>

</html>