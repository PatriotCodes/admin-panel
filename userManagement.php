<?php
session_start();
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");
require_once(LIBRARY_PATH."/paginator.class.php");

if(isset($_GET['idInput'])) {
  $_SESSION['userID'] = $_GET['idInput'];
}

$likeClause = '';
$orderClause = '';
$innerJoin = 'LEFT JOIN workaction ON workaction.actionID = appointment.actionID LEFT JOIN actioncategory ON workaction.categoryID = actioncategory.categoryID WHERE appointment.workerID = '.$_SESSION['userID'];

if (isset($_GET['search'])) {
  $likeClause = "AND actionName LIKE '%".$_GET['search']."%' OR categoryName LIKE '%".$_GET['search']."%' OR fromDate LIKE '%".$_GET['search']."%' OR toDate LIKE '%".$_GET['search']."%'";
}

if (isset($_GET['groupOption'])) {
  $orderClause = "ORDER BY ".$_GET['groupOption']." ".$_GET['orderOption'];
}

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

$colNames = array('�����','��������','������','��','��');
$tableColNames = array('row','actionName','categoryName','fromDate','toDate');
$pagNames = array('row','actionName','categoryName','fromDate','toDate','workaction.actionID');
$view->set('idName','appointmentID');
$view->set('options',$colNames);
$view->set('tableName','appointment');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./updateAppointment.php');
$view->set('isDeletable',true);
$view->set('actionName','��������');
$hiddenVars = array('idInput' => 'appointmentID');
$view->display('filterForm.tpl'); 

$paginator = new Paginator($db,"appointment",50,"appointmentID");

if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$rows = $paginator->getData($page,$likeClause,$orderClause,$innerJoin,$pagNames);
$view->set('rows',$rows);
?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <form action="./addAppointment.php" method="post">
        <button name="userID" class="btn btn-success" type="submit" value="<?php echo $_SESSION['userID']; ?>"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">�������� ������ ������������</a></button>
      </form>
    </div>
    <?php $view->display('table.tpl'); ?>
    <?php $paginator->outputNavigation(); ?>
</div>

<?php $view->display('footer.tpl'); ?>