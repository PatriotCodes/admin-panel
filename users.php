<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$colNames = array('Логин');
$tableColNames = array('username');
$view->set('idName','workerID');
$view->set('options',$colNames);
$view->set('tableName','worker');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./userManagement.php');
$view->set('actionName','Управление ресурсами');
$view->set('isDeletable',true);

if (isset($_POST['search'])) {
	$view->set('likeClause',"WHERE username LIKE '%".$_POST['search']."%'");
}

if (isset($_POST['groupOption'])) {
	if ($_POST['groupOption'] != '#') {
		$view->set('orderClause',"ORDER BY ".$_POST['groupOption']." ".$_POST['orderOption']);
	} else {
		$view->set('orderClause',"ORDER BY workerID ".$_POST['orderOption']);
	}
}

$view->display('filterForm.tpl');
?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <button name="add" onclick="location.href = './addUser.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить пользователя</a></button>
    </div>
    <?php $view->display('table.tpl'); ?>
</div>


<?php $view->display('footer.tpl'); ?>