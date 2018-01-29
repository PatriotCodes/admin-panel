<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

?>

<div class="container">
  <div class="text-right mt-2 mb-2">
    <input name="add" onclick="location.href = './addGroup.php'" class="btn btn-success" value="+ Добавить группу">
  </div>
	<table class="table table-striped table-bordered table-condensed">
        <thead class="thead-dark">
	        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $db = new DB();
              $categories = $db->query("SELECT * FROM actioncategory");
              foreach($categories as $row)
              {
                echo '<tr>';
                echo '<td scope="row">'.$row['categoryID'].'</td>';
                echo '<td>'.$row['categoryName'].'</td>';
                echo '<td class="">
                  <form action="./updateGroup.php" method="get">
                    <input name="edit" id="'.$row['categoryID'].'" class="btn btn-info" value="Изменить" type="submit">
                    <input type="hidden" value="'.$row['categoryID'].'" name="idInput"/>
                    <input name="delete" id="'.$row['categoryID'].'" class="btn btn-danger deleteRowButton" value="Удалить" type="button">
                  </form>
                </td>';
                echo '</tr>';
              }
              ?>   
        </tbody>
        </table>
</div>

<?php $view->display('footer.tpl'); ?>