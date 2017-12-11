<?php

$action = isset($_GET["action"])? $_GET["action"]: '';

/*Includes the header class files and database connections*/
include '../includes/header.php'; 
 include '../includes/class/guestbook.class.php';
 
 $guestbook = new guestbook;

if ($_SERVER["DOCUMENT_ROOT"] == '/var/www/websites/redesign2013'){
		
	require("/var/www/websites/redesign2013/includes/connection.php");
		
}else{
			
	require("/home/ycyrf718/public_html/redesign2013/includes/connection.php");
}

?>

<div class="container">
<div id="menu">
</div>

<!--content here-->
<?php
switch($action){
	case 'delete':
	
		echo $guestbook ->display_guestbook_admin_delete();
	
	break;
	case 'deleteConfirm';
		
		echo $guestbook ->display_guestbook_admin_delete_confirm();
		
	break;
	case 'deleteMulti':
	
		echo $guestbook ->display_guestbook_admin_delete_multi();
	
	break;
	case 'deleteMultiConfirm':
	
		echo $guestbook ->display_guestbook_admin_delete_confirm();
	
	break;
	case 'edit';
	
		echo $guestbook ->display_guestbook_admin_edit();
	
	break;
	case 'editSave':
	
		echo $guestbook ->display_guestbook_admin_edit_save();
	
	break;
	case 'editUpdate';
	
		echo $guestbook ->display_guestbook_admin_edit_update();
	
	break;
	case 'save':
	
		echo $guestbook ->display_guestbook_admin_save();
	
	break;
	case 'saveConfirm':
		
		echo $guestbook ->display_guestbook_admin_save_confirm();
		
	break;
	case 'saveMulti':
		
		echo $guestbook ->display_guestbook_admin_save_multi();
		
	break;
	case 'saveMultiConfirm':
	
		echo $guestbook ->display_guestbook_admin_save_confirm();
	
	break;
	default:
		
		echo $guestbook ->display_guestbook_admin_default();
		
	break;

}

/*Includes the footer*/
include '../includes/footer.php'; 

?>

</div>



</body>

</html>