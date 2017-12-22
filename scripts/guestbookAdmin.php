<?php

$action = isset($_GET["action"])? $_GET["action"]: '';

/*Includes the header class files and database connections*/
include '../includes/header.php'; 
 include '../includes/class/guestbook.class.php';
 
 $guestbook = new guestbook;

?>

<div class="container">
<div id="menu">
</div>

<!--content here-->
<?php
switch($action){
	case 'delete':
	
		echo $guestbook ->display_guestbook_admin_delete($database);
	
	break;
	case 'deleteConfirm';
		
		echo $guestbook ->display_guestbook_admin_delete_confirm($database);
		
	break;
	case 'deleteMulti':
	
		echo $guestbook ->display_guestbook_admin_delete_multi();
	
	break;
	case 'deleteMultiConfirm':
	
		echo $guestbook ->display_guestbook_admin_delete_confirm($database);
	
	break;
	case 'edit';
	
		echo $guestbook ->display_guestbook_admin_edit($database);
	
	break;
	case 'editSave':
	
		echo $guestbook ->display_guestbook_admin_edit_save();
	
	break;
	case 'editUpdate';
	
		echo $guestbook ->display_guestbook_admin_edit_update($database);
	
	break;
	case 'save':
	
		echo $guestbook ->display_guestbook_admin_save($database);
	
	break;
	case 'saveConfirm':
		
		echo $guestbook ->display_guestbook_admin_save_confirm($database);
		
	break;
	case 'saveMulti':
		
		echo $guestbook ->display_guestbook_admin_save_multi($database);
		
	break;
	case 'saveMultiConfirm':
	
		echo $guestbook ->display_guestbook_admin_save_confirm($database);
	
	break;
	default:
		
		echo $guestbook ->display_guestbook_admin_default($database);
		
	break;

}

/*Includes the footer*/
include '../includes/footer.php'; 

?>

</div>



</body>

</html>