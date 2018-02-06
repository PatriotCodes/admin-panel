<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");
require_once(LIBRARY_PATH."/paginator.class.php");

if(isset($_GET['idInput'])) {
  $_SESSION['userID'] = $_GET['idInput'];
}

$likeClause = '';
$orderClause = '';
$innerJoin = 'LEFT JOIN workaction ON workaction.actionID = appointment.actionID INNER JOIN actioncategory ON workaction.categoryID = actioncategory.categoryID WHERE appointment.workerID = '.$_GET['idInput'];

if (isset($_POST['search'])) {
  $likeClause = "AND actionName LIKE '%".$_POST['search']."%'";
}

if (isset($_POST['groupOption'])) {
  $orderClause = "ORDER BY ".$_POST['groupOption']." ".$_POST['orderOption'];
}

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

$colNames = array('Номер','Название','Группа','от','до');
$tableColNames = array('row','actionName','categoryName','fromDate','toDate');
$pagNames = array('row','actionName','categoryName','fromDate','toDate','workaction.actionID');
$view->set('idName','appointmentID');
$view->set('options',$colNames);
$view->set('tableName','appointment');
$view->set('tableColNames',$tableColNames);
$view->set('actionPage','./updateAppointment.php');
$view->set('isDeletable',true);
$view->set('actionName','Изменить');
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
        <button name="userID" class="btn btn-success" type="submit" value="<?php echo $_GET['idInput']; ?>"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить ресурс пользователя</a></button>
      </form>
    </div>
    <?php $view->display('table.tpl'); ?>
    <?php $paginator->outputNavigation(); ?>
</div>

<?php $view->display('footer.tpl'); ?>