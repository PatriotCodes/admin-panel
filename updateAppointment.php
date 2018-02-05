<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$date = $db->query("SELECT * FROM appointment WHERE appointmentID = '$_GET[idInput]'");

if (isset($_POST['dateFrom']) && isset($_POST['dateTo']) ) {
	$success = $db->query("UPDATE actionCategory SET categoryName = N'$_POST[categoryName]' WHERE categoryID = '$_GET[idInput]'");
} else {
	$success = false;
}
if ($success) { 
  header("refresh:2;url=./userManagment.php"); 
}
?>

<div class="container">
  <form class="form-control mt-4" method="post">
  	<div class="form-row md-5">
      <label class="mt-2">От:</label>
        <div class="col-md-5">
          <div class="form-group">
      		<input type="date" class="form-control" name="fromDate" id="from">
        </div>
      </div>
      <label class="mt-2">До:</label>
        <div class="col-md-5">
          <div class="form-group">
          <input type="date" class="form-control" name="toDate" id="to">
        </div>
      </div>
      	</div>
      		<?php if($success) {
      		echo '<div class="form-row"><div class="col-md-8">
      			<div class="alert alert-success mb-2">
  					Данные успешно обновлены! Вы будете автоматически возвращены на странницу <a href="./userManagment.php" class="alert-link">управления ресурсами</a>.</div></div><div class="col-md-4">';
      		} ?>
      		    <div class=text-right>
        			<button class="btn btn-primary mt-2 mb-1" type="submit">Сохранить</button>
      			</div>
      		</div>
	    </div>
  </form>
</div>

<?php $view->display('footer.tpl'); ?>