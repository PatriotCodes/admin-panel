<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");
require_once(LIBRARY_PATH."/paginator.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

$likeClause = '';
$orderClause = '';
$innerJoin = '';

if (isset($_POST['search'])) {
	$likeClause = "AND username LIKE '%".$_POST['search']."%'";
}

if (isset($_POST['groupOption'])) {
	$orderClause = "ORDER BY ".$_POST['groupOption']." ".$_POST['orderOption'];
}

$colNames = array('Номер','Логин');
$tableColNames = array('row','username');
$view->set('idName','workerID');
$view->set('options',$colNames);
$view->set('tableName','worker');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./userManagement.php');
$view->set('actionName','Управление ресурсами');
$view->set('isDeletable',true);

$paginator = new Paginator($db,"worker",50,"workerID");

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$rows = $paginator->getData($page,$likeClause,$orderClause,$innerJoin,$tableColNames);
$view->set('rows',$rows);

$view->display('filterForm.tpl');
?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <button name="add" onclick="location.href = './addUser.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить пользователя</a></button>
    </div>
    <?php $view->display('table.tpl'); ?>
    <?php $paginator->outputNavigation(); ?>
</div>


<?php $view->display('footer.tpl'); ?>