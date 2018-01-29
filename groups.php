<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl'); ?>

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
            <th class="header">#</th>
            <th class="yellow header headerSortDown">ID</th>
            <th class="red header">Название</th>
            <th class="red header"></th>
            </tr>
        </thead>
        <tbody>
            <?php
              $db = new DB();
              $categories = $db->query("SELECT * FROM actioncategory");
              $counter = 0;
              foreach($categories as $row)
              {
              	$counter++;
                echo '<tr>';
                echo '<td>'.$counter.'</td>';
                echo '<td>'.$row['categoryID'].'</td>';
                echo '<td>'.$row['categoryName'].'</td>';
                echo '<td class="">
                  <a href="/actionGroups/update/'.$row['categoryID'].'" class="btn btn-info">view & edit</a>  
                  <a href="/actionGroups/delete/'.$row['categoryID'].'" class="btn btn-danger">delete</a>
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