<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$date = $db->query("SELECT * FROM appointment WHERE appointmentID = '$_GET[idInput]'");

if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
  if ($_POST['toDate'] != '') {
	 $success = $db->query("UPDATE appointment SET fromDate = '$_POST[fromDate]', toDate = '$_POST[toDate]' WHERE appointmentID = '$_GET[idInput]'");
  } else {
    $success = $db->query("UPDATE appointment SET fromDate = '$_POST[fromDate]', toDate = NULL WHERE appointmentID = '$_GET[idInput]'");
  }
} else {
	$success = false;
}
if ($success) { 
  header('refresh:2;url=./userManagement.php?idInput='.$_GET['destinationID']); 
}
?>

<div class="container">
  <form class="form-control mt-4" method="post">
  	<div class="form-row md-5">
      <label class="mt-2">От:</label>
        <div class="col-md-5">
          <div class="form-group">
      		<input type="date" class="form-control" name="fromDate" id="from" value="<?php echo $date[0]['fromDate'];?>">
        </div>
      </div>
      <label class="mt-2">До:</label>
        <div class="col-md-5">
          <div class="form-group">
          <input type="date" class="form-control" name="toDate" id="to" value="<?php echo $date[0]['toDate'];?>">
        </div>
      </div>
      	</div>
      		<?php if($success) {
      		echo '<div class="form-row"><div class="col-md-8">
      			<div class="alert alert-success mb-2">
  					Данные успешно обновлены! Вы будете автоматически возвращены на странницу <a href="';
            echo './userManagement.php?idInput='.$_GET['destinationID'];
            echo '" class="alert-link">управления ресурсами</a>.</div></div><div class="col-md-4">';
      		} ?>
      		    <div class=text-right>
        			<button class="btn btn-primary mt-2 mb-1" type="submit">Сохранить</button>
      			</div>
      		</div>
	    </div>
  </form>
</div>

<?php $view->display('footer.tpl'); ?>