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

<div class="container"
<div class="row">
    <div class="span12 columns">
        <div class="form-group">
    		<div class="col-sm-10">
		</div>
	</div>
	<table class="table table-striped table-bordered table-condensed">
        <thead>
	        <tr>
            <th class="yellow header headerSortDown">ID</th>
            <th class="red header">Название</th>
            <th class="red header">Строка</th>
            <th class="red header">Аргументы</th>
            <th class="red header">Группа</th>
            <th class="red header"></th>
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
                echo '<td>'.$row['actionID'].'</td>';
                echo '<td>'.$row['actionName'].'</td>';
                echo '<td>'.$row['actionString'].'</td>';
                echo '<td>'.$row['actionArguments'].'</td>';
                echo '<td>'.$category['categoryName'].'</td>';
                echo '<td class="">
                  <input name="edit" id="$row[categoryID]" class="btn btn-info" value="View & Edit" type="submit">
                  <input name="delete" id="$row[actionID]" class="btn btn-danger deleteRowButton" value="Delete" type="submit" onClick="">
                </td>';
                echo '</tr>';
              }
              ?>   
        </tbody>
        </table>
    </div>
</div>
</div>

<?php $view->display('footer.tpl');?>