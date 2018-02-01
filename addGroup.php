<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');


if (isset($_POST['categoryName'])) {
	$success = $db->query("INSERT INTO actioncategory (categoryName) VALUES (N'$_POST[categoryName]');");
} else {
	$success = false;
}
?>

<div class="container">
  <form class="form-control mt-4" method="post">
  		<div class="form-row mb-3">
      		<input type="text" class="form-control mt-2" name="categoryName" placeholder="Название" required>
      	</div>
      		<?php if($success) {
      		echo '<div class="form-row"><div class="col-md-8">
      			<div class="alert alert-success mb-2">
  					Группа была успешно добавлена!
	    		</div></div><div class="col-md-4">';
      		} ?>
      		    <div class=text-right>
        			<button class="btn btn-primary mt-2 mb-1" type="submit">Добавить</button>
      			</div>
      		</div>
        </form>
	    </div>
</div>

<?php $view->display('footer.tpl'); ?>