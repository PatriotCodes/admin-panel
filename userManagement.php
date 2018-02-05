<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

if(isset($_GET['idInput'])) {
  $_SESSION['userID'] = $_GET['idInput'];
}

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$colNames = array('Название','Группа','от','до');
$view->set('options',$colNames);
$view->display('filterForm.tpl'); ?>

<div class="container">
    <div class="text-right mt-2 mb-2">
      <form action="./addAppointment.php" method="post">
        <button name="userID" class="btn btn-success" type="submit" value="<?php echo $_GET['idInput']; ?>"><i class="fa fa-plus" aria-hidden="true"></i><a  class="ml-2">Добавить ресурс пользователя</a></button>
      </form>
    </div>
<table class="table table-striped table-bordered table-condensed">
        <thead class="thead-dark">
	        <tr>
            <th scope="col">№</th>
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
                $counter = 0;
                foreach($appointments as $appointment) {
                  $counter++;
                  $action = $db->query("SELECT * FROM workAction WHERE actionID = '$appointment[actionID]'");
                  $categoryID = $action[0]['categoryID'];
                  $category = $db->query("SELECT * FROM actioncategory WHERE categoryID = '$categoryID'");           
                  echo '<tr ';
                  if ($appointment['toDate'] != '') {
                    $dbDate = $appointment['toDate'];
                    $today_date = new DateTime();
                    $today_date = date_format($today_date, 'Y-m-d');
                    if ((strtotime($today_date) - strtotime($dbDate)) > 0) {
                      echo 'class="table-danger"';
                    }
                  }
                  echo '>';
                  echo '<td>'.$counter.'</td>';
                  echo '<td>'.$action[0]['actionName'].'</td>';
                  echo '<td>'.$category[0]['categoryName'].'</td>';
                  echo '<td>'.$appointment['fromDate'].'</td>';
                  echo '<td>'.$appointment['toDate'].'</td>';
                  echo '<td class="">
                  <form action="./actions.php" method="get">
                  <input name="edit" id="'.$appointment['actionID'].'" class="btn btn-info mb-1" value="Просмотреть ресурс" type="submit">
                    <input type="hidden" value="'.$appointment['actionID'].'" name="idAppointment"/>
                  </form>
                  <form action="./updateAppointment.php" method="get">';
                     // echo '<input name="edit" id="'.$appointment['appointmentID'].'" class="btn btn-info mb-1" value="Изменить" type="submit">';
                    echo '<input type="hidden" value="'.$appointment['appointmentID'].'" name="idInput"/>
                    <button name="appointment" id="'.$appointment['appointmentID'].'" class="btn btn-danger deleteRowButton mb-1" value="appointmentID" type="button">Удалить</button>
                  </form></td>';
                  echo '</tr>';
                }
              } ?>   
        </tbody>
        </table>
    </div>

<?php $view->display('footer.tpl'); ?>