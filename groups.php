<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

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
            <th class="red header"></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $db = new DB();
              $categories = $db->query("SELECT * FROM actioncategory");
              foreach($categories as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['categoryID'].'</td>';
                echo '<td>'.$row['categoryName'].'</td>';
                echo '<td class="">
                  <input name="edit" id="$row[categoryID]" class="btn btn-info" value="View & Edit" type="submit">
                  <input name="delete" id="'.$row['categoryID'].'" class="btn btn-danger deleteRowButton" value="Delete" type="submit">
                </td>';
                echo '</tr>';
              }
              ?>   
        </tbody>
        </table>
    </div>
</div>
</div>

<?php $view->display('footer.tpl'); ?>