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
$innerJoin = 'LEFT JOIN actioncategory ON workaction.categoryID = actioncategory.categoryID';

if (isset($_POST['search'])) {
  $likeClause = "AND actionName LIKE '%".$_POST['search']."%' OR actionString LIKE '%".$_POST['search']."%' OR actionArguments LIKE '%".$_POST['search']."%' OR categoryName LIKE '%".$_POST['search']."%'";
}

if (isset($_POST['groupOption'])) {
    $orderClause = "ORDER BY ".$_POST['groupOption']." ".$_POST['orderOption'];
}

$colNames = array('Номер','Название','Строка','Аргументы','Группа');
$tableColNames = array('row','actionName','actionString','actionArguments','categoryName');
$pagNames = array('row','actionName','actionString','actionArguments','categoryName','workaction.categoryID');
$view->set('idName','actionID');
$view->set('options',$colNames);
$view->set('tableName','workaction');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./updateAction.php');
$view->set('isDeletable',true);
$view->set('actionName','Изменить');
$hiddenVars = array('idCat' => 'categoryID');
$view->set('hiddenVars',$hiddenVars);

$paginator = new Paginator($db,"workaction",2,"actionID");

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$view->set('focusID','');
if (isset($_GET['idAppointment'])) {
  $view->set('focusID',$_GET['idAppointment']);
  $page = $paginator->pageByID($_GET['idAppointment']);
}

$rows = $paginator->getData($page,$likeClause,$orderClause,$innerJoin,$pagNames);
$view->set('rows',$rows);

$view->display('filterForm.tpl');

?>

<div class="container">
  <div class="text-right mt-2 mb-2">
        <button name="add" onclick="location.href = './addAction.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a class="ml-2">Добавить ресурс</a></button>
  </div>
  <?php $view->display('table.tpl'); ?>
    <?php $paginator->outputNavigation(); ?>
</div>

<?php $view->display('footer.tpl');?>