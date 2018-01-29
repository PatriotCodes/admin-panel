<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin-panel/resources/config.php");
require_once(LIBRARY_PATH."/db.class.php");
if(isset($_POST['id'])){
	$db = new DB();
 	$db->query("DELETE FROM actioncategory WHERE categoryID = $_POST[id]");
}
?>