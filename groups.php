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

if (isset($_GET['search'])) {
	$likeClause = "AND categoryName LIKE '%".$_GET['search']."%'";
}

if (isset($_GET['groupOption'])) {
	$orderClause = "ORDER BY ".$_GET['groupOption']." ".$_GET['orderOption'];
}

$colNames = array('Номер','Название');
$tableColNames = array('row','categoryName');
$view->set('idName','categoryID');
$view->set('options',$colNames);
$view->set('tableName','actioncategory');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./updateGroup.php');
$view->set('isDeletable',true);
$view->set('actionName','Изменить');

$paginator = new Paginator($db,"actioncategory",50,"categoryID");

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$rows = $paginator->getData($page,$likeClause,$orderClause,$innerJoin,$tableColNames);
$view->set('rows',$rows);
$view->set('alertMes',true);

$view->display('filterForm.tpl'); ?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <button name="add" onclick="location.href = './addGroup.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить группу</a></button>
    </div>
    <?php $view->display('table.tpl'); ?>
    <?php $paginator->outputNavigation(); ?>
</div>

<?php $view->display('footer.tpl'); ?>