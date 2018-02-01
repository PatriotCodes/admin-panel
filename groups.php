<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

if (isset($_POST['search'])) {
	$view->set('likeClause',"WHERE categoryName LIKE '%".$_POST['search']."%'");
}

if (isset($_POST['groupOption'])) {
	if ($_POST['groupOption'] != '#') {
		$view->set('orderClause',"ORDER BY ".$_POST['groupOption']." ".$_POST['orderOption']);
	} else {
		$view->set('orderClause',"ORDER BY categoryID ".$_POST['orderOption']);
	}
}

$colNames = array('Название');
$tableColNames = array('categoryName');
$view->set('idName','categoryID');
$view->set('options',$colNames);
$view->set('tableName','actioncategory');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./updateGroup.php');
$view->set('isDeletable',true);
$view->set('actionName','Изменить');

$view->display('filterForm.tpl');
?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <button name="add" onclick="location.href = './addGroup.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить группу</a></button>
    </div>
    <?php $view->display('table.tpl'); ?>
</div>

<?php $view->display('footer.tpl'); ?>