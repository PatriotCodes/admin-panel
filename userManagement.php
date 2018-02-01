<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$colNames = array('Название','Группа','от','до');
$view->set('options',$colNames);
$view->display('filterForm.tpl'); ?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <button name="add" onclick="location.href = './addAppointment.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить ресурс пользователя</a></button>
    </div>
<table class="table table-striped table-bordered table-condensed">
        <thead class="thead-dark">
	        <tr>
            <th scope="col">Название</th>
            <th scope="col">Группа</th>
            <th scope="col">От</th>
            <th scope="col">До</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $db = new DB();
              $appointments = $db->query("SELECT * FROM appointment WHERE workerID='$_GET[idInput]'");
              if ($appointments) {
                foreach($appointments as $appointment) {
                  $action = $db->query("SELECT * FROM workAction WHERE actionID = '$appointment[actionID]'");
                  $categoryID = $action[0]['categoryID'];
                  $category = $db->query("SELECT * FROM actioncategory WHERE categoryID = '$categoryID'");           
                  echo '<tr>';
                  echo '<td>'.$action[0]['actionName'].'</td>';
                  echo '<td>'.$category[0]['categoryName'].'</td>';
                  echo '<td>'.$appointment['fromDate'].'</td>';
                  echo '<td>'.$appointment['toDate'].'</td>';
                  echo '<td class="">
                  <form action="./actions.php" method="get">
                  <input name="edit" id="'.$appointment['actionID'].'" class="btn btn-info mb-1" value="Просмотреть ресурс" type="submit">
                    <input type="hidden" value="'.$appointment['actionID'].'" name="idInput"/>
                  </form>
                  <form action="./updateAppointment.php" method="get">
                    <input name="edit" id="'.$appointment['appointmentID'].'" class="btn btn-info mb-1" value="Изменить" type="submit">
                    <input type="hidden" value="'.$appointment['appointmentID'].'" name="idInput"/>
                    <button name="workaction" id="'.$appointment['appointmentID'].'" class="btn btn-danger deleteRowButton mb-1" value="actionID" type="button">Удалить</button>
                  </form></td>';
                  echo '</tr>';
                }
              } ?>   
        </tbody>
        </table>
    </div>

<?php $view->display('footer.tpl'); ?>