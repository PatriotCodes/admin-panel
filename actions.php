<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

if(isset($_POST['delete'])) {
  $db = new DB();
  $db->query("DELETE FROM workaction WHERE actionID = $_POST[id]");
}
?>

	<div class="container">
  <div class="text-right mt-2 mb-2">
    <input name="add" onclick="location.href = './addAction.php'" class="btn btn-success" value="+ Добавить ресурс">
  </div>
  <table class="table table-striped table-bordered table-condensed">
        <thead class="thead-dark">
	        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Строка</th>
            <th scope="col">Аргументы</th>
            <th scope="col">Группа</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $db = new DB();
              $actions = $db->query("SELECT * FROM workaction");
              foreach($actions as $row)
              {
                $category = $db->query("SELECT categoryName FROM actioncategory WHERE categoryID = '$row[categoryID]'");
                echo '<tr>';
                echo '<td scope="row">'.$row['actionID'].'</td>';
                echo '<td>'.$row['actionName'].'</td>';
                echo '<td>'.$row['actionString'].'</td>';
                echo '<td>'.$row['actionArguments'].'</td>';
                echo '<td>'.$category['categoryName'].'</td>';
                echo '<td class="">
                  <h2><input name="edit" id="$row[categoryID]" class="btn btn-info" value="Изменить" type="submit"></h2>
                  <h2><input name="delete" id="$row[actionID]" class="btn btn-danger deleteRowButton" value="Удалить" type="submit"></h2>
                </td>';
                echo '</tr>';
              }
              ?>   
        </tbody>
        </table>
    </div>

<?php $view->display('footer.tpl');?>