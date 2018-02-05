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
$innerJoin = 'INNER JOIN actioncategory ON workaction.categoryID = actioncategory.categoryID';

if (isset($_POST['search'])) {
  $likeClause = "AND actionName LIKE '%".$_POST['search']."%'";
}

if (isset($_POST['groupOption'])) {
    $orderClause = "ORDER BY ".$_POST['groupOption']." ".$_POST['orderOption'];
}

$colNames = array('Номер','Название','Строка','Аргументы','Группа');
$tableColNames = array('row','actionName','actionString','actionArguments','categoryName');
$view->set('idName','actionID');
$view->set('options',$colNames);
$view->set('tableName','workaction');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./updateAction.php');
$view->set('isDeletable',true);
$view->set('actionName','Изменить');

$paginator = new Paginator($db,"workaction",50,"actionID");

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$rows = $paginator->getData($page,$likeClause,$orderClause,$innerJoin,$tableColNames);
$view->set('rows',$rows);

$view->display('filterForm.tpl');

$view->set('focusID','');
if (isset($_GET['idAppointment'])) {
  $view->set('focusID',$_GET['idAppointment']);
}

// TODO: set appropriate page for this focusID
?>

<div class="container">
  <div class="text-right mt-2 mb-2">
        <button name="add" onclick="location.href = './addAction.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a class="ml-2">Добавить ресурс</a></button>
  </div>
  <?php $view->display('table.tpl'); ?>
    <?php $paginator->outputNavigation(); ?>
</div>

<?php $view->display('footer.tpl');?>