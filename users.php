<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$colNames = array('ID','Логин');
$view->set('options',$colNames);
$view->display('filterForm.tpl');
?>

<div class="container">
  <div class="text-right mt-2 mb-2">
    <button name="add" onclick="location.href = './addUser.php'" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i><a class="ml-2">Добавить пользователя</a></button>
  </div>
	<table class="table table-striped table-bordered table-condensed">
        <thead class="thead-dark">
	        <tr>
            <th scope="col">ID</th>
            <th scope="col">Логин</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            <?php
              $db = new DB();
              $users = $db->query("SELECT * FROM worker");
              foreach($users as $row)
              {
                echo '<tr>';
                echo '<td scope="row">'.$row['workerID'].'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td class="">
                  <form action="./userActions.php" method="get">
                    <input name="edit" id="'.$row['workerID'].'" class="btn btn-info mb-1" value="Ресурсы пользователя" type="submit">
                    <input type="hidden" value="'.$row['workerID'].'" name="idInput"/>
                  </form>
                </td>';
                echo '</tr>';
              }
              ?>   
        </tbody>
        </table>
</div>

<?php $view->display('footer.tpl'); ?>